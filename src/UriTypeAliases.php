<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
 * [_UriTypeAliases_][] provides custom PHPStan types to aid static analysis.
 *
 * - `composed_string`
 *     - A concatenation of `encoded_string`s with component-appropriate
 *       `string` delimiters.
 *
 * - `decoded_string`
 *     - The result of decoding an `encoded_string`.
 *
 * - `encoded_string`
 *     - A `formurl_encoded_string` or `percent_encoded_string`.
 *
 * - `formurl_composed_string`
 *     - A concatenation of `formurl_encoded_string`s with component-appropriate
 *       `string` delimiters.
 *
 * - `formurl_encoded_string`
 *     - An `application/x-www-form-urlencoded` string, with `+` for the space
 *       character.
 *
 * - ```
 *   parse_url_array array{
 *       scheme?:string,
 *       user?:string,
 *       pass?:string,
 *       host?:string,
 *       port?:?int,
 *       path?:string,
 *       query?:string,
 *       fragment?:string
 *   }
 *   ```
 *     - The array return from [`parse_url()`][].
 *
 * - `percent_composed_string`
 *     - A concatenation of `percent_encoded_string`s with component-appropriate
 *       `string` delimiters.
 *
 * - `percent_encoded_string`
 *     - A percent-encoded string, with `%20` for the space character.
 *
 * - `query_params_array`
 *     - An associative array of up to 16 dimensions with `decoded_string` keys
 *       and `decoded_string` values.
 *
 * - Notes:
 *
 *     - **Native PHP functions will suffice for the type aliases.**
 *       Implementations may provide their own alternative functionality.
 *
 *         - [`http_build_query()`][] with `encoding_type: PHP_QUERY_1738` will
 *           encode each space character as `+`, returning a
 *           `formurl_encoded_string`.
 *
 *         - [`http_build_query()`][] with `encoding_type: PHP_QUERY_3986` will
 *           encode each space character as `%20`, returning a
 *           `percent_encoded_string`.
 *
 *         - [`parse_str()`][] will decode both `+` and `%20` to a space
 *           character, returning a `query_params_array`.
 *
 *         - [`rawurlencode()`][] will encode each space character as `%20`,
 *           returning a `percent_encoded_string`.
 *
 *         - [`urldecode()`][] will decode both `+` and `%20` to a space
 *           character, returning a `decoded_string`.
 *
 *         - [`urlencode()`][] will encode each space character as `+`,
 *           returning a `formurl_encoded_string`.
 *
 *     - **The `*_[00-0F]` types are to enable limited recursion.** PHPStan
 *       does not handle recursive type aliases, so `query_params_array`
 *       cannot ever refer back to itself. As a result, that type alias
 *       refers to the `*_[00-0F]` types to enable recursion to 16
 *       dimensions. Consumers need not use these recursion-enabling type
 *       aliases.
 *
 * @phpstan-type composed_string string
 *
 * @phpstan-type decoded_string string
 *
 * @phpstan-type encoded_string formurl_encoded_string|percent_encoded_string
 *
 * @phpstan-type formurl_composed_string string
 *
 * @phpstan-type formurl_encoded_string string
 *
 * @phpstan-type parse_url_array array{
 *    scheme?:string,
 *    user?:string,
 *    pass?:string,
 *    host?:string,
 *    port?:?int,
 *    path?:string,
 *    query?:string,
 *    fragment?:string
 * }
 *
 * @phpstan-type percent_composed_string string
 *
 * @phpstan-type percent_encoded_string string
 *
 * @phpstan-type query_params_array    array<decoded_string, decoded_string|query_params_array_00>
 * @phpstan-type query_params_array_00 array<decoded_string, decoded_string|query_params_array_01>
 * @phpstan-type query_params_array_01 array<decoded_string, decoded_string|query_params_array_02>
 * @phpstan-type query_params_array_02 array<decoded_string, decoded_string|query_params_array_03>
 * @phpstan-type query_params_array_03 array<decoded_string, decoded_string|query_params_array_04>
 * @phpstan-type query_params_array_04 array<decoded_string, decoded_string|query_params_array_05>
 * @phpstan-type query_params_array_05 array<decoded_string, decoded_string|query_params_array_06>
 * @phpstan-type query_params_array_06 array<decoded_string, decoded_string|query_params_array_07>
 * @phpstan-type query_params_array_07 array<decoded_string, decoded_string|query_params_array_08>
 * @phpstan-type query_params_array_08 array<decoded_string, decoded_string|query_params_array_09>
 * @phpstan-type query_params_array_09 array<decoded_string, decoded_string|query_params_array_0A>
 * @phpstan-type query_params_array_0A array<decoded_string, decoded_string|query_params_array_0B>
 * @phpstan-type query_params_array_0B array<decoded_string, decoded_string|query_params_array_0C>
 * @phpstan-type query_params_array_0C array<decoded_string, decoded_string|query_params_array_0D>
 * @phpstan-type query_params_array_0D array<decoded_string, decoded_string|query_params_array_0E>
 * @phpstan-type query_params_array_0E array<decoded_string, decoded_string|query_params_array_0F>
 * @phpstan-type query_params_array_0F array<decoded_string, decoded_string>
 */
interface UriTypeAliases
{
}
