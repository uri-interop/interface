<?php
declare(strict_types=1);

namespace UriInterop\Interface;

/**
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
 * @phpstan-type path_segments_array array<int, decoded_string>
 *
 * @phpstan-type percent_composed_string string
 *
 * @phpstan-type percent_encoded_string string
 *
 * @phpstan-type query_params_array    array<decoded_string, decoded_string>|query_params_array_00
 * @phpstan-type query_params_array_00 array<decoded_string, decoded_string>|query_params_array_01
 * @phpstan-type query_params_array_01 array<decoded_string, decoded_string>|query_params_array_02
 * @phpstan-type query_params_array_02 array<decoded_string, decoded_string>|query_params_array_03
 * @phpstan-type query_params_array_03 array<decoded_string, decoded_string>|query_params_array_04
 * @phpstan-type query_params_array_04 array<decoded_string, decoded_string>|query_params_array_05
 * @phpstan-type query_params_array_05 array<decoded_string, decoded_string>|query_params_array_06
 * @phpstan-type query_params_array_06 array<decoded_string, decoded_string>|query_params_array_07
 * @phpstan-type query_params_array_07 array<decoded_string, decoded_string>|query_params_array_08
 * @phpstan-type query_params_array_08 array<decoded_string, decoded_string>|query_params_array_09
 * @phpstan-type query_params_array_09 array<decoded_string, decoded_string>|query_params_array_0A
 * @phpstan-type query_params_array_0A array<decoded_string, decoded_string>|query_params_array_0B
 * @phpstan-type query_params_array_0B array<decoded_string, decoded_string>|query_params_array_0C
 * @phpstan-type query_params_array_0C array<decoded_string, decoded_string>|query_params_array_0D
 * @phpstan-type query_params_array_0D array<decoded_string, decoded_string>|query_params_array_0E
 * @phpstan-type query_params_array_0E array<decoded_string, decoded_string>|query_params_array_0F
 * @phpstan-type query_params_array_0F array<decoded_string, decoded_string>
 */
interface UriTypeAliases
{
}
