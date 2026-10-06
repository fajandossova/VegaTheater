#!/usr/bin/env python3
"""
Переводы темы «Вега» — инструмент для разработчика (владелице сайта он не нужен).

  python3 tools/i18n.py pot      — собрать vega/languages/vega.pot из PHP-файлов темы
  python3 tools/i18n.py mo       — скомпилировать все vega/languages/*.po в .mo
  python3 tools/i18n.py check    — показать непереведённые строки в .po

Работает на чистом Python 3, без gettext и без npm.
"""
import ast
import glob
import os
import re
import struct
import sys

ROOT = os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', 'vega')
LANG_DIR = os.path.join(ROOT, 'languages')

STR = r"'((?:[^'\\]|\\.)*)'"
SEP = r"\s*,\s*"
PATTERNS = [
    # (regex, kind)
    (re.compile(r"\b(?:__|_e|esc_html__|esc_html_e|esc_attr__|esc_attr_e)\(\s*" + STR + SEP + r"'vega'\s*\)"), 'simple'),
    (re.compile(r"\b(?:_x|_ex|esc_html_x|esc_attr_x)\(\s*" + STR + SEP + STR + SEP + r"'vega'\s*\)"), 'context'),
    (re.compile(r"\b_n\(\s*" + STR + SEP + STR + SEP + r"[^,]+?" + SEP + r"'vega'\s*\)"), 'plural'),
]


def unescape(s):
    return s.replace("\\'", "'").replace('\\\\', '\\')


def po_escape(s):
    return s.replace('\\', '\\\\').replace('"', '\\"').replace('\n', '\\n')


def extract():
    entries = {}  # key -> dict
    files = sorted(glob.glob(os.path.join(ROOT, '**', '*.php'), recursive=True))
    for path in files:
        rel = os.path.relpath(path, ROOT)
        src = open(path, encoding='utf-8').read()
        for regex, kind in PATTERNS:
            for m in regex.finditer(src):
                line = src.count('\n', 0, m.start()) + 1
                if kind == 'simple':
                    key = (None, unescape(m.group(1)))
                    entry = {'ctx': None, 'id': key[1], 'plural': None}
                elif kind == 'context':
                    key = (unescape(m.group(2)), unescape(m.group(1)))
                    entry = {'ctx': key[0], 'id': key[1], 'plural': None}
                else:
                    key = (None, unescape(m.group(1)))
                    entry = {'ctx': None, 'id': key[1], 'plural': unescape(m.group(2))}
                entries.setdefault(key, entry).setdefault('refs', []).append('%s:%d' % (rel, line))
    return entries


def write_pot(entries):
    out = [
        'msgid ""', 'msgstr ""',
        '"Project-Id-Version: Vega 1.0.0\\n"',
        '"MIME-Version: 1.0\\n"',
        '"Content-Type: text/plain; charset=UTF-8\\n"',
        '"Content-Transfer-Encoding: 8bit\\n"',
        '"X-Domain: vega\\n"', '',
    ]
    for key in sorted(entries, key=lambda k: (entries[k]['refs'][0])):
        e = entries[key]
        out.append('#: ' + ' '.join(e['refs']))
        if e['ctx']:
            out.append('msgctxt "%s"' % po_escape(e['ctx']))
        out.append('msgid "%s"' % po_escape(e['id']))
        if e['plural']:
            out.append('msgid_plural "%s"' % po_escape(e['plural']))
            out.append('msgstr[0] ""')
            out.append('msgstr[1] ""')
        else:
            out.append('msgstr ""')
        out.append('')
    path = os.path.join(LANG_DIR, 'vega.pot')
    open(path, 'w', encoding='utf-8').write('\n'.join(out))
    print('%s: %d строк' % (path, len(entries)))


def parse_po(path):
    """Возвращает (заголовок, список записей {ctx,id,plural,str:[...]})."""
    entries = []
    cur = None
    last = None

    def lit(s):
        return ast.literal_eval(s)

    for raw in open(path, encoding='utf-8'):
        line = raw.strip()
        if not line or line.startswith('#'):
            if cur is not None and line == '':
                entries.append(cur)
                cur = None
            continue
        if cur is None:
            cur = {'ctx': None, 'id': None, 'plural': None, 'str': {}}
        m = re.match(r'(msgctxt|msgid_plural|msgid|msgstr(?:\[(\d+)\])?)\s+(".*")$', line)
        if m:
            kw, idx, val = m.group(1), m.group(2), lit(m.group(3))
            if kw == 'msgctxt':
                cur['ctx'] = val; last = ('ctx', None)
            elif kw == 'msgid':
                cur['id'] = val; last = ('id', None)
            elif kw == 'msgid_plural':
                cur['plural'] = val; last = ('plural', None)
            else:
                i = int(idx) if idx is not None else 0
                cur['str'][i] = val; last = ('str', i)
        elif line.startswith('"'):
            val = lit(line)
            if last[0] == 'str':
                cur['str'][last[1]] += val
            else:
                cur[last[0]] = (cur[last[0]] or '') + val
    if cur is not None:
        entries.append(cur)
    return entries


def write_mo(entries, path):
    pairs = []
    for e in entries:
        if e['id'] is None:
            continue
        key = e['id']
        if e['ctx']:
            key = e['ctx'] + '\x04' + key
        if e['plural']:
            key = key + '\x00' + e['plural']
            strs = [e['str'][i] for i in sorted(e['str'])]
            if not any(strs):
                continue
            val = '\x00'.join(strs)
        else:
            val = e['str'].get(0, '')
            if e['id'] != '' and not val:
                continue
        pairs.append((key.encode('utf-8'), val.encode('utf-8')))
    pairs.sort()
    n = len(pairs)
    ids = b''
    strs = b''
    offsets = []
    for k, v in pairs:
        offsets.append((len(ids), len(k), len(strs), len(v)))
        ids += k + b'\x00'
        strs += v + b'\x00'
    keystart = 7 * 4 + 16 * n
    valuestart = keystart + len(ids)
    koffsets = []
    voffsets = []
    for o1, l1, o2, l2 in offsets:
        koffsets += [l1, o1 + keystart]
        voffsets += [l2, o2 + valuestart]
    # Адрес хеш-таблицы указываем сразу за таблицами строк (как msgfmt):
    # WordPress 6.5+ считает по нему длину таблицы переводов.
    data = struct.pack('Iiiiiii', 0x950412de, 0, n, 7 * 4, 7 * 4 + n * 8, 0, keystart)
    data += struct.pack('%di' % len(koffsets), *koffsets)
    data += struct.pack('%di' % len(voffsets), *voffsets)
    data += ids + strs
    open(path, 'wb').write(data)
    print('%s: %d переводов' % (path, n - 1))


def main():
    cmd = sys.argv[1] if len(sys.argv) > 1 else ''
    if cmd == 'pot':
        write_pot(extract())
    elif cmd == 'mo':
        for po in sorted(glob.glob(os.path.join(LANG_DIR, '*.po'))):
            write_mo(parse_po(po), po[:-3] + '.mo')
    elif cmd == 'check':
        wanted = extract()
        for po in sorted(glob.glob(os.path.join(LANG_DIR, '*.po'))):
            have = {(e['ctx'], e['id']): e for e in parse_po(po) if e['id']}
            missing = [k for k in wanted if k not in have or not any(have[k]['str'].values())]
            print('%s: не переведено %d' % (os.path.basename(po), len(missing)))
            for k in missing:
                print('   ', k)
    else:
        print(__doc__)


if __name__ == '__main__':
    main()
