import { decode } from 'parseqs';

export function decodeHashParams (str) {
    if (!str || !str.length) return {};
    if (str.startsWith('#')) return decode(str.slice(1));
    return decode(str);
}
