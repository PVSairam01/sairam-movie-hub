<?php

/**
 * ============================================================
 * SAIRAM MOVIE HUB
 * WATCHMODE API CONFIGURATION
 * ============================================================
 *
 * Smart Watchmode filtering:
 *
 * LATEST MOVIES
 * ----------------
 * Telugu recent movies
 * English Action / Horror / Sci-Fi / Adventure / Superhero
 *
 * OTT
 * ----------------
 * JioHotstar Telugu TV / shows
 * Netflix + Amazon Prime latest Action / Thriller /
 * Sci-Fi / Adventure / Fighting / Racing type content
 *
 * ============================================================
 */


/* ============================================================
   WATCHMODE API KEY
   ============================================================ */

define(
    'SAIRAM_WATCHMODE_API_KEY',
    'DEFBadYnFdaAuNsHaTNGmACSVntSii8OKw9wojxU'
);


/* ============================================================
   API BASE
   ============================================================ */

define(
    'SAIRAM_WATCHMODE_API_BASE',
    'https://api.watchmode.com/v1/'
);


/* ============================================================
   REGION
   ============================================================ */

define(
    'SAIRAM_WATCHMODE_REGION',
    'IN'
);


/* ============================================================
   DEFAULT LANGUAGE
   ============================================================ */

define(
    'SAIRAM_WATCHMODE_LANGUAGE',
    'en'
);


/* ============================================================
   CACHE
   ============================================================ */

define(
    'SAIRAM_WATCHMODE_CACHE_DIR',
    __DIR__ . '/../assets/cache/watchmode'
);


define(
    'SAIRAM_WATCHMODE_CACHE_TTL',
    21600
);


/* ============================================================
   CREATE CACHE DIRECTORY
   ============================================================ */

if (
    !is_dir(
        SAIRAM_WATCHMODE_CACHE_DIR
    )
) {

    @mkdir(
        SAIRAM_WATCHMODE_CACHE_DIR,
        0755,
        true
    );

}


/* ============================================================
   API CONFIGURED
   ============================================================ */

function sairamWatchmodeConfigured()
{
    if (
        !defined(
            'SAIRAM_WATCHMODE_API_KEY'
        )
    ) {
        return false;
    }

    $key = trim(
        SAIRAM_WATCHMODE_API_KEY
    );

    if (
        $key === ''
        ||
        $key === 'YOUR_WATCHMODE_API_KEY_HERE'
    ) {
        return false;
    }

    return true;
}


/* ============================================================
   CACHE FILE
   ============================================================ */

function sairamWatchmodeCacheFile(
    $cacheKey
) {

    $safeKey = preg_replace(
        '/[^a-zA-Z0-9_\-]/',
        '_',
        $cacheKey
    );

    return
        SAIRAM_WATCHMODE_CACHE_DIR
        . '/'
        . $safeKey
        . '.json';
}


/* ============================================================
   READ CACHE
   ============================================================ */

function sairamWatchmodeReadCache(
    $cacheKey
) {

    $file =
        sairamWatchmodeCacheFile(
            $cacheKey
        );

    if (
        !file_exists($file)
    ) {
        return null;
    }

    $modified =
        @filemtime($file);

    if (
        !$modified
        ||
        (
            time() - $modified
        ) > SAIRAM_WATCHMODE_CACHE_TTL
    ) {
        return null;
    }

    $contents =
        @file_get_contents($file);

    if (
        $contents === false
    ) {
        return null;
    }

    $data =
        json_decode(
            $contents,
            true
        );

    if (
        !is_array($data)
    ) {
        return null;
    }

    return $data;
}


/* ============================================================
   WRITE CACHE
   ============================================================ */

function sairamWatchmodeWriteCache(
    $cacheKey,
    $data
) {

    $file =
        sairamWatchmodeCacheFile(
            $cacheKey
        );

    @file_put_contents(
        $file,
        json_encode(
            $data,
            JSON_UNESCAPED_SLASHES
            |
            JSON_UNESCAPED_UNICODE
        ),
        LOCK_EX
    );
}


/* ============================================================
   WATCHMODE API REQUEST
   ============================================================ */

function sairamWatchmodeRequest(
    $endpoint,
    $params = [],
    $cacheKey = null,
    $useCache = true
) {

    if (
        !sairamWatchmodeConfigured()
    ) {
        return [];
    }


    /* --------------------------------------------------------
       CACHE
       -------------------------------------------------------- */

    if (
        $useCache
        &&
        $cacheKey !== null
    ) {

        $cached =
            sairamWatchmodeReadCache(
                $cacheKey
            );

        if (
            $cached !== null
        ) {
            return $cached;
        }
    }


    /* --------------------------------------------------------
       URL
       -------------------------------------------------------- */

    $url =
        rtrim(
            SAIRAM_WATCHMODE_API_BASE,
            '/'
        )
        . '/'
        . ltrim(
            $endpoint,
            '/'
        );


    if (
        !empty($params)
    ) {

        $url .=
            '?'
            .
            http_build_query(
                $params
            );
    }


    /* --------------------------------------------------------
       CURL
       -------------------------------------------------------- */

    $ch =
        curl_init();


    curl_setopt_array(
        $ch,
        [

            CURLOPT_URL =>
                $url,

            CURLOPT_RETURNTRANSFER =>
                true,

            CURLOPT_FOLLOWLOCATION =>
                true,

            CURLOPT_TIMEOUT =>
                20,

            CURLOPT_CONNECTTIMEOUT =>
                10,

            CURLOPT_HTTPHEADER =>
                [

                    'Accept: application/json',

                    'X-API-Key: '
                    . SAIRAM_WATCHMODE_API_KEY

                ],

            CURLOPT_USERAGENT =>
                'Sairam Movie Hub/1.0'

        ]
    );


    $response =
        curl_exec($ch);


    $httpCode =
        (int) curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );


    $curlError =
        curl_error($ch);


    curl_close($ch);


    if (
        $response === false
        ||
        $curlError !== ''
    ) {
        return [];
    }


    if (
        $httpCode < 200
        ||
        $httpCode >= 300
    ) {
        return [];
    }


    $data =
        json_decode(
            $response,
            true
        );


    if (
        !is_array($data)
    ) {
        return [];
    }


    if (
        $cacheKey !== null
    ) {

        sairamWatchmodeWriteCache(
            $cacheKey,
            $data
        );
    }


    return $data;
}


/* ============================================================
   STATUS
   ============================================================ */

function sairamWatchmodeStatus()
{
    return sairamWatchmodeRequest(
        'status',
        [],
        null,
        false
    );
}


/* ============================================================
   GENRE MAP
   ============================================================ */

function sairamWatchmodeGenreMap()
{

    static $genres = null;


    if (
        $genres !== null
    ) {
        return $genres;
    }


    $data =
        sairamWatchmodeRequest(
            'genres',
            [],
            'genres',
            true
        );


    $genres = [];


    if (
        is_array($data)
    ) {

        foreach (
            $data as $genre
        ) {

            if (
                isset(
                    $genre['id'],
                    $genre['name']
                )
            ) {

                $genres[
                    (int) $genre['id']
                ] =
                    trim(
                        $genre['name']
                    );
            }
        }
    }


    return $genres;
}


/* ============================================================
   FIND GENRE IDS
   ============================================================ */

function sairamWatchmodeGenreIds(
    $wantedGenres = []
) {

    $map =
        sairamWatchmodeGenreMap();


    $ids = [];


    if (
        empty($wantedGenres)
    ) {
        return [];
    }


    foreach (
        $map as $id => $name
    ) {

        $nameLower =
            strtolower(
                trim($name)
            );


        foreach (
            $wantedGenres as $wanted
        ) {

            $wantedLower =
                strtolower(
                    trim($wanted)
                );


            if (
                $nameLower === $wantedLower
            ) {

                $ids[] =
                    (int) $id;

                break;
            }
        }
    }


    return array_values(
        array_unique(
            $ids
        )
    );
}


/* ============================================================
   GENRE TEXT
   ============================================================ */

function sairamWatchmodeGenreText(
    $genres
) {

    if (
        empty($genres)
    ) {
        return 'Movie';
    }


    if (
        is_string($genres)
    ) {

        return
            trim($genres) !== ''
                ? trim($genres)
                : 'Movie';
    }


    if (
        !is_array($genres)
    ) {
        return 'Movie';
    }


    $genreMap =
        sairamWatchmodeGenreMap();


    $names = [];


    foreach (
        $genres as $genre
    ) {

        if (
            is_array($genre)
        ) {

            $name =
                $genre['name']
                ?? '';

            if (
                $name !== ''
            ) {
                $names[] = $name;
            }

            continue;
        }


        $genreId =
            (int) $genre;


        if (
            isset(
                $genreMap[$genreId]
            )
        ) {

            $names[] =
                $genreMap[$genreId];
        }
    }


    $names =
        array_values(
            array_unique(
                array_filter(
                    $names
                )
            )
        );


    if (
        empty($names)
    ) {
        return 'Movie';
    }


    return implode(
        ' • ',
        array_slice(
            $names,
            0,
            3
        )
    );
}


/* ============================================================
   LANGUAGE LABEL
   ============================================================ */

function sairamWatchmodeLanguageLabel(
    $movie
) {

    if (
        !is_array($movie)
    ) {
        return 'Movie';
    }


    if (
        !empty(
            $movie['_sairam_language']
        )
    ) {

        return
            $movie['_sairam_language'];
    }


    $language =
        $movie['language']
        ??
        $movie['original_language']
        ??
        '';


    $map = [

        'en' => 'English',
        'te' => 'Telugu',
        'hi' => 'Hindi',
        'ta' => 'Tamil',
        'ml' => 'Malayalam',
        'kn' => 'Kannada',
        'bn' => 'Bengali',
        'mr' => 'Marathi',
        'pa' => 'Punjabi',
        'gu' => 'Gujarati',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'ja' => 'Japanese',
        'ko' => 'Korean'

    ];


    $key =
        strtolower(
            trim(
                (string) $language
            )
        );


    if (
        isset($map[$key])
    ) {
        return $map[$key];
    }


    return
        $key !== ''
            ? ucfirst($key)
            : 'Movie';
}


/* ============================================================
   POSTER
   ============================================================ */

function sairamWatchmodePoster(
    $movie
) {

    if (
        !is_array($movie)
    ) {

        return
            'https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';
    }


    $fields = [

        'poster_url',
        'poster',
        'image_url',
        'thumbnail_url'

    ];


    foreach (
        $fields as $field
    ) {

        if (
            !empty($movie[$field])
            &&
            is_string($movie[$field])
        ) {

            return
                trim(
                    $movie[$field]
                );
        }
    }


    return
        'https://placehold.co/500x750/0b0b0b/d6aa3d?text=No+Poster';
}


/* ============================================================
   RELEASE DATE
   ============================================================ */

function sairamWatchmodeReleaseDate(
    $movie
) {

    if (
        !is_array($movie)
    ) {
        return '';
    }


    return
        $movie['release_date']
        ?? '';
}


/* ============================================================
   TITLE DETAILS
   ============================================================ */

function sairamWatchmodeTitleDetails(
    $watchmodeId,
    $includeSources = false,
    $appendToResponse = ''
) {

    $watchmodeId = (int) $watchmodeId;

    if ($watchmodeId <= 0) {
        return [];
    }

    $params = [
        'language' => SAIRAM_WATCHMODE_LANGUAGE
    ];

    $appendParts = [];

    if ($includeSources) {
        $appendParts[] = 'sources';

        $params['regions'] =
            SAIRAM_WATCHMODE_REGION;
    }

    if (
        is_string($appendToResponse) &&
        trim($appendToResponse) !== ''
    ) {
        $extraParts = array_map(
            'trim',
            explode(',', $appendToResponse)
        );

        foreach ($extraParts as $part) {
            if ($part !== '') {
                $appendParts[] = $part;
            }
        }
    }

    if (!empty($appendParts)) {
        $params['append_to_response'] =
            implode(
                ',',
                array_values(
                    array_unique($appendParts)
                )
            );
    }

    $cacheSuffix = '';

    if ($includeSources) {
        $cacheSuffix .= '_sources';
    }

    if (!empty($appendParts)) {
        $cacheSuffix .=
            '_'
            .
            implode(
                '_',
                $appendParts
            );
    }

    $cacheKey =
        'title_'
        . $watchmodeId
        . $cacheSuffix;

    return sairamWatchmodeRequest(
        'title/'
        . $watchmodeId
        . '/details',
        $params,
        $cacheKey,
        true
    );
}


/* ============================================================
   SOURCE CATALOG
   ============================================================ */

function sairamWatchmodeSourceCatalog()
{

    static $sources = null;


    if (
        $sources !== null
    ) {
        return $sources;
    }


    $data =
        sairamWatchmodeRequest(
            'sources',
            [
                'regions' =>
                    SAIRAM_WATCHMODE_REGION
            ],
            'sources_'
            . SAIRAM_WATCHMODE_REGION,
            true
        );


    $sources = [];


    if (
        is_array($data)
    ) {

        foreach (
            $data as $source
        ) {

            if (
                empty($source['id'])
                ||
                empty($source['name'])
            ) {
                continue;
            }


            $sources[] =
                $source;
        }
    }


    return $sources;
}


/* ============================================================
   FIND STREAMING SOURCE IDS
   ============================================================ */

function sairamWatchmodeFindSourceIds(
    $keywords = []
) {

    $catalog =
        sairamWatchmodeSourceCatalog();


    $ids = [];


    foreach (
        $catalog as $source
    ) {

        $name =
            strtolower(
                trim(
                    $source['name']
                    ?? ''
                )
            );


        if (
            $name === ''
        ) {
            continue;
        }


        foreach (
            $keywords as $keyword
        ) {

            $keyword =
                strtolower(
                    trim(
                        $keyword
                    )
                );


            if (
                $keyword !== ''
                &&
                strpos(
                    $name,
                    $keyword
                ) !== false
            ) {

                $ids[] =
                    (int) $source['id'];

                break;
            }
        }
    }


    return array_values(
        array_unique(
            $ids
        )
    );
}


/* ============================================================
   SOURCE INFORMATION MAP
   ============================================================ */

function sairamWatchmodeSourceInfoMap()
{

    static $map = null;


    if (
        $map !== null
    ) {
        return $map;
    }


    $map = [];


    foreach (
        sairamWatchmodeSourceCatalog()
        as $source
    ) {

        $id =
            (int) (
                $source['id']
                ?? 0
            );


        if (
            $id <= 0
        ) {
            continue;
        }


        $map[$id] =
            $source;
    }


    return $map;
}


/* ============================================================
   NORMALIZE STREAMING PROVIDERS
   ============================================================ */

function sairamWatchmodeProviders(
    $sources
) {

    if (
        empty($sources)
        ||
        !is_array($sources)
    ) {
        return [];
    }


    $catalog =
        sairamWatchmodeSourceInfoMap();


    $providers = [];


    foreach (
        $sources as $source
    ) {

        if (
            !is_array($source)
        ) {
            continue;
        }


        $sourceId =
            (int) (
                $source['source_id']
                ??
                $source['id']
                ??
                0
            );


        $catalogSource =
            $catalog[$sourceId]
            ?? [];


        $name =
            trim(
                (string) (
                    $source['name']
                    ??
                    $source['source_name']
                    ??
                    $catalogSource['name']
                    ??
                    'OTT'
                )
            );


        $type =
            strtolower(
                trim(
                    (string) (
                        $source['type']
                        ??
                        $catalogSource['type']
                        ??
                        ''
                    )
                )
            );


        $region =
            strtoupper(
                trim(
                    (string) (
                        $source['region']
                        ??
                        SAIRAM_WATCHMODE_REGION
                    )
                )
            );


        $webUrl =
            trim(
                (string) (
                    $source['web_url']
                    ??
                    ''
                )
            );


        $logo100 =
            trim(
                (string) (
                    $source['logo_100px']
                    ??
                    $catalogSource['logo_100px']
                    ??
                    $catalogSource['logo_url']
                    ??
                    ''
                )
            );


        if (
            $name === ''
        ) {
            continue;
        }


        $providers[] = [

            'id' =>
                $sourceId,

            'name' =>
                $name,

            'type' =>
                $type,

            'region' =>
                $region,

            'web_url' =>
                $webUrl,

            'logo_100px' =>
                $logo100,

            'logo_url' =>
                $logo100

        ];
    }


    $unique = [];


    foreach (
        $providers as $provider
    ) {

        $key =
            strtolower(
                $provider['name']
            )
            . '_'
            . $provider['type'];


        $unique[$key] =
            $provider;
    }


    return array_values(
        $unique
    );
}


/* ============================================================
   WATCH LINK
   ============================================================ */

function sairamWatchmodeWatchLink(
    $sources
) {

    if (
        empty($sources)
        ||
        !is_array($sources)
    ) {
        return '';
    }


    $priorityTypes = [

        'sub',
        'free',
        'tve',
        'purchase',
        'rent',
        'buy'

    ];


    foreach (
        $priorityTypes as $wantedType
    ) {

        foreach (
            $sources as $source
        ) {

            if (
                !is_array($source)
            ) {
                continue;
            }


            $type =
                strtolower(
                    trim(
                        (string) (
                            $source['type']
                            ?? ''
                        )
                    )
                );


            if (
                $type !== $wantedType
            ) {
                continue;
            }


            $webUrl =
                trim(
                    (string) (
                        $source['web_url']
                        ?? ''
                    )
                );


            if (
                $webUrl !== ''
            ) {
                return $webUrl;
            }
        }
    }


    foreach (
        $sources as $source
    ) {

        if (
            !is_array($source)
        ) {
            continue;
        }


        $webUrl =
            trim(
                (string) (
                    $source['web_url']
                    ?? ''
                )
            );


        if (
            $webUrl !== ''
        ) {
            return $webUrl;
        }
    }


    return '';
}


/* ============================================================
   ENRICH MOVIE
   ============================================================ */

function sairamWatchmodeEnrichMovie(
    $movie,
    $includeSources = false
) {

    if (
        !is_array($movie)
    ) {
        return null;
    }


    $watchmodeId =
        (int) (
            $movie['id']
            ??
            $movie['watchmode_id']
            ??
            0
        );


    if (
        $watchmodeId <= 0
    ) {
        return null;
    }


    $details =
        sairamWatchmodeTitleDetails(
            $watchmodeId,
            $includeSources
        );


    if (
        is_array($details)
        &&
        !empty($details)
    ) {

        $movie =
            array_merge(
                $movie,
                $details
            );
    }


    $movie['watchmode_id'] =
        $watchmodeId;


    if (
        empty($movie['tmdb_id'])
        &&
        !empty($details['tmdb_id'])
    ) {

        $movie['tmdb_id'] =
            (int) $details['tmdb_id'];
    }


    $movie['_sairam_language'] =
        sairamWatchmodeLanguageLabel(
            $movie
        );


    $movie['poster_url'] =
        sairamWatchmodePoster(
            $movie
        );


    if (
        isset(
            $movie['user_rating']
        )
    ) {

        $movie['rating'] =
            $movie['user_rating'];

    } elseif (
        isset(
            $movie['rating']
        )
    ) {

        $movie['rating'] =
            $movie['rating'];
    }


    $genres =
        $movie['genres']
        ?? [];


    $movie['_sairam_genres'] =
        sairamWatchmodeGenreText(
            $genres
        );


    $movie['genre_text'] =
        $movie['_sairam_genres'];


    if (
        $includeSources
    ) {

        $sources =
            $movie['sources']
            ?? [];


        $movie['_sairam_providers'] =
            sairamWatchmodeProviders(
                $sources
            );


        $movie['_sairam_watch_link'] =
            sairamWatchmodeWatchLink(
                $sources
            );

    } else {

        $movie['_sairam_providers'] =
            [];

        $movie['_sairam_watch_link'] =
            '';
    }


    return $movie;
}


/* ============================================================
   TEXT MATCH HELPER
   ============================================================ */

function sairamWatchmodeText(
    $movie
) {

    if (
        !is_array($movie)
    ) {
        return '';
    }


    $parts = [

        $movie['title']
        ?? '',

        $movie['original_title']
        ?? '',

        $movie['plot_overview']
        ?? '',

        $movie['overview']
        ?? '',

        $movie['genre_text']
        ?? ''

    ];


    return strtolower(
        implode(
            ' ',
            $parts
        )
    );
}


/* ============================================================
   GENRE MATCH HELPER
   ============================================================ */

function sairamWatchmodeMovieHasGenre(
    $movie,
    $wantedGenres
) {

    if (
        !is_array($movie)
        ||
        empty($wantedGenres)
    ) {
        return false;
    }


    $genres =
        $movie['genres']
        ?? [];


    if (
        !is_array($genres)
    ) {
        return false;
    }


    $map =
        sairamWatchmodeGenreMap();


    $wanted = [];


    foreach (
        $wantedGenres as $genre
    ) {

        $wanted[] =
            strtolower(
                trim(
                    $genre
                )
            );
    }


    foreach (
        $genres as $genre
    ) {

        if (
            is_array($genre)
        ) {

            $name =
                strtolower(
                    trim(
                        $genre['name']
                        ?? ''
                    )
                );

        } else {

            $id =
                (int) $genre;

            $name =
                strtolower(
                    trim(
                        $map[$id]
                        ?? ''
                    )
                );
        }


        if (
            in_array(
                $name,
                $wanted,
                true
            )
        ) {
            return true;
        }
    }


    return false;
}


/* ============================================================
   FILTER + SCORE MOVIES
   ============================================================ */

function sairamWatchmodeScoreMovie(
    $movie,
    $mode = 'latest'
) {

    if (
        !is_array($movie)
    ) {
        return -9999;
    }


    $score = 0;


    $text =
        sairamWatchmodeText(
            $movie
        );


    $language =
        strtolower(
            trim(
                (string) (
                    $movie['language']
                    ??
                    $movie['original_language']
                    ??
                    ''
                )
            )
        );


    /* --------------------------------------------------------
       RECENCY
       -------------------------------------------------------- */

    $release =
        $movie['release_date']
        ?? '';


    if (
        $release !== ''
    ) {

        $timestamp =
            strtotime($release);


        if (
            $timestamp !== false
        ) {

            $days =
                max(
                    0,
                    floor(
                        (
                            time()
                            -
                            $timestamp
                        )
                        /
                        86400
                    )
                );


            if (
                $days <= 30
            ) {

                $score += 50;

            } elseif (
                $days <= 90
            ) {

                $score += 35;

            } elseif (
                $days <= 180
            ) {

                $score += 20;

            } elseif (
                $days <= 365
            ) {

                $score += 10;
            }
        }
    }


    /* --------------------------------------------------------
       RATING
       -------------------------------------------------------- */

    $rating =
        (float) (
            $movie['user_rating']
            ??
            $movie['rating']
            ??
            0
        );


    $score +=
        $rating * 2;


    /* --------------------------------------------------------
       LATEST MOVIES
       -------------------------------------------------------- */

    if (
        $mode === 'latest'
    ) {

        if (
            $language === 'te'
        ) {

            $score += 100;
        }


        if (
            $language === 'en'
        ) {

            $score += 30;
        }


        if (
            sairamWatchmodeMovieHasGenre(
                $movie,
                [
                    'Action',
                    'Horror',
                    'Science Fiction',
                    'Adventure'
                ]
            )
        ) {

            $score += 40;
        }


        $superheroWords = [

            'marvel',
            'avenger',
            'avengers',
            'spider-man',
            'spiderman',
            'batman',
            'superman',
            'supergirl',
            'wonder woman',
            'deadpool',
            'x-men',
            'xmen',
            'venom',
            'fantastic four',
            'captain america',
            'thor',
            'guardians of the galaxy',
            'black panther',
            'ant-man',
            'doctor strange',
            'aquaman',
            'flash'

        ];


        foreach (
            $superheroWords as $word
        ) {

            if (
                strpos(
                    $text,
                    $word
                ) !== false
            ) {

                $score += 80;

                break;
            }
        }
    }


    /* --------------------------------------------------------
       OTT
       -------------------------------------------------------- */

    if (
        $mode === 'ott'
    ) {

        if (
            $language === 'te'
        ) {

            $score += 30;
        }


        if (
            $language === 'en'
        ) {

            $score += 25;
        }


        if (
            sairamWatchmodeMovieHasGenre(
                $movie,
                [
                    'Action',
                    'Thriller',
                    'Science Fiction',
                    'Adventure',
                    'Crime',
                    'Horror',
                    'Sport'
                ]
            )
        ) {

            $score += 50;
        }


        $specialWords = [

            'fight',
            'fighting',
            'martial',
            'boxing',
            'mma',
            'wrestling',
            'race',
            'racing',
            'car race',
            'street race',
            'motorsport',
            'formula',
            'formula 1',
            'formula one',
            'speed',
            'driver',
            'drivers',
            'spy',
            'alien',
            'superhero'

        ];


        foreach (
            $specialWords as $word
        ) {

            if (
                strpos(
                    $text,
                    $word
                ) !== false
            ) {

                $score += 25;
            }
        }
    }


    return $score;
}


/* ============================================================
   DEDUPLICATE TITLES
   ============================================================ */

function sairamWatchmodeUniqueTitles(
    $movies
) {

    $unique = [];


    foreach (
        $movies as $movie
    ) {

        if (
            !is_array($movie)
        ) {
            continue;
        }


        $id =
            (int) (
                $movie['watchmode_id']
                ??
                $movie['id']
                ??
                0
            );


        if (
            $id <= 0
        ) {
            continue;
        }


        $unique[$id] =
            $movie;
    }


    return array_values(
        $unique
    );
}


/* ============================================================
   SORT BY SMART SCORE
   ============================================================ */

function sairamWatchmodeSortSmart(
    $movies,
    $mode = 'latest'
) {

    foreach (
        $movies as &$movie
    ) {

        $movie['_sairam_score'] =
            sairamWatchmodeScoreMovie(
                $movie,
                $mode
            );
    }

    unset($movie);


    usort(
        $movies,
        function (
            $a,
            $b
        ) {

            return
                (
                    $b['_sairam_score']
                    ??
                    0
                )
                <=>
                (
                    $a['_sairam_score']
                    ??
                    0
                );
        }
    );


    return $movies;
}

/* ============================================================
   LATEST MOVIES
   FIXED VERSION
   - OTT function untouched
   - Telugu movies
   - English Action / Horror / Sci-Fi / Adventure
   - Marvel / Superhero type movies
   - Latest first
   ============================================================ */

function sairamWatchmodeLatestMovies(
    $limit = 15
) {

    $limit = max(
        1,
        min(
            50,
            (int) $limit
        )
    );


    /*
     * Last 365 days
     */
    $startDate = date(
        'Ymd',
        strtotime('-365 days')
    );

    $endDate = date('Ymd');


    /*
     * ========================================================
     * 1. TELUGU MOVIES
     * ========================================================
     *
     * IMPORTANT:
     * We DO NOT depend on $movie['language'] from the
     * list-titles response.
     *
     * Instead, Watchmode itself filters:
     *
     * languages=te
     *
     */

    $teluguParams = [

        'types' =>
            'movie',

        'regions' =>
            SAIRAM_WATCHMODE_REGION,

        'languages' =>
            'te',

        'release_date_start' =>
            $startDate,

        'release_date_end' =>
            $endDate,

        'sort_by' =>
            'release_date_desc',

        'page' =>
            1,

        'limit' =>
            50
    ];


    /*
     * New cache key so old empty/failed cache
     * does not interfere.
     */
    $teluguCacheKey =
        'latest_movies_telugu_v2_'
        . SAIRAM_WATCHMODE_REGION;


    $teluguData =
        sairamWatchmodeRequest(
            'list-titles',
            $teluguParams,
            $teluguCacheKey,
            true
        );


    $movies = [];


    /*
     * Add Telugu movies
     */
    if (
        is_array($teluguData)
        &&
        !empty($teluguData['titles'])
        &&
        is_array($teluguData['titles'])
    ) {

        foreach (
            $teluguData['titles'] as $movie
        ) {

            if (
                !is_array($movie)
            ) {
                continue;
            }


            /*
             * Make sure it is a movie.
             */
            if (
                isset($movie['type'])
                &&
                strtolower(
                    (string) $movie['type']
                ) !== 'movie'
            ) {
                continue;
            }


            /*
             * We already know this came from:
             *
             * languages=te
             *
             * So don't check $movie['language'] here.
             */
            $movie['_sairam_language'] = 'te';


            /*
             * Enrich title.
             *
             * If enrichment fails, we still keep the
             * basic Watchmode list item.
             */
            try {

                $enriched =
                    sairamWatchmodeEnrichMovie(
                        $movie,
                        false
                    );

                if (
                    is_array($enriched)
                ) {

                    /*
                     * Preserve our language marker.
                     */
                    $enriched['_sairam_language'] =
                        'te';

                    $movies[] =
                        $enriched;

                } else {

                    $movies[] =
                        $movie;
                }

            } catch (Throwable $e) {

                /*
                 * Do NOT make the entire section fail
                 * because one title's details failed.
                 */
                $movies[] =
                    $movie;
            }
        }
    }


    /*
     * ========================================================
     * 2. ENGLISH MOVIES
     * ========================================================
     *
     * Again, language filtering is performed by Watchmode:
     *
     * languages=en
     *
     * We don't depend on the list item's language field.
     */


    /*
     * Get genre IDs from Watchmode.
     *
     * Existing helper already exists in your file.
     */
    $genreMap =
        sairamWatchmodeGenreMap();


    $englishGenreIds = [];


    if (
        is_array($genreMap)
        &&
        !empty($genreMap)
    ) {

        $wantedGenres = [

            'action',

            'horror',

            'science fiction',

            'adventure'
        ];


        foreach (
            $genreMap as $genreName => $genreId
        ) {

            $normalized =
                strtolower(
                    trim(
                        (string) $genreName
                    )
                );


            foreach (
                $wantedGenres as $wantedGenre
            ) {

                if (
                    $normalized ===
                    $wantedGenre
                ) {

                    $englishGenreIds[] =
                        (string) $genreId;

                    break;
                }
            }
        }
    }


    /*
     * Remove duplicate genre IDs.
     */
    $englishGenreIds =
        array_values(
            array_unique(
                $englishGenreIds
            )
        );


    $englishParams = [

        'types' =>
            'movie',

        'regions' =>
            SAIRAM_WATCHMODE_REGION,

        'languages' =>
            'en',

        'release_date_start' =>
            $startDate,

        'release_date_end' =>
            $endDate,

        'sort_by' =>
            'release_date_desc',

        'page' =>
            1,

        'limit' =>
            50
    ];


    /*
     * If Watchmode returned genre IDs, use them.
     *
     * Otherwise the broad English query still works.
     */
    if (
        !empty($englishGenreIds)
    ) {

        $englishParams['genres'] =
            implode(
                ',',
                $englishGenreIds
            );
    }


    $englishCacheKey =
        'latest_movies_english_v2_'
        . SAIRAM_WATCHMODE_REGION;


    $englishData =
        sairamWatchmodeRequest(
            'list-titles',
            $englishParams,
            $englishCacheKey,
            true
        );


    /*
     * Add English movies
     */
    if (
        is_array($englishData)
        &&
        !empty($englishData['titles'])
        &&
        is_array($englishData['titles'])
    ) {

        foreach (
            $englishData['titles'] as $movie
        ) {

            if (
                !is_array($movie)
            ) {
                continue;
            }


            if (
                isset($movie['type'])
                &&
                strtolower(
                    (string) $movie['type']
                ) !== 'movie'
            ) {
                continue;
            }


            /*
             * We know this came from:
             *
             * languages=en
             */
            $movie['_sairam_language'] = 'en';


            /*
             * Enrich English title so we can inspect
             * genres / overview / title for superhero
             * and category matching.
             */
            try {

                $temp =
                    sairamWatchmodeEnrichMovie(
                        $movie,
                        false
                    );

            } catch (Throwable $e) {

                $temp = null;
            }


            /*
             * If enrichment fails, skip this English
             * movie because we cannot safely determine
             * whether it belongs to our preferred genres.
             */
            if (
                !is_array($temp)
            ) {
                continue;
            }


            $temp['_sairam_language'] =
                'en';


            /*
             * =================================================
             * GENRE CHECK
             * =================================================
             */

            $validEnglish =
                false;


            try {

                $validEnglish =
                    sairamWatchmodeMovieHasGenre(
                        $temp,
                        [
                            'Action',
                            'Horror',
                            'Science Fiction',
                            'Adventure'
                        ]
                    );

            } catch (Throwable $e) {

                $validEnglish = false;
            }


            /*
             * =================================================
             * SUPERHERO / MARVEL CHECK
             * =================================================
             *
             * We check title + overview + related text.
             */

            $text =
                strtolower(
                    sairamWatchmodeText(
                        $temp
                    )
                );


            $superhero =
                false;


            $superheroWords = [

                'marvel',

                'avenger',

                'avengers',

                'spider-man',

                'spiderman',

                'batman',

                'superman',

                'deadpool',

                'x-men',

                'x men',

                'venom',

                'fantastic four',

                'thor',

                'aquaman',

                'black panther',

                'doctor strange',

                'captain america',

                'superhero',

                'super hero',

                'superpowered',

                'super-powered'

            ];


            foreach (
                $superheroWords as $word
            ) {

                if (
                    strpos(
                        $text,
                        $word
                    ) !== false
                ) {

                    $superhero =
                        true;

                    break;
                }
            }


            /*
             * Keep only preferred English content.
             */
            if (
                !$validEnglish
                &&
                !$superhero
            ) {

                continue;
            }


            $movies[] =
                $temp;
        }
    }


    /*
     * ========================================================
     * REMOVE DUPLICATES
     * ========================================================
     */

    $movies =
        sairamWatchmodeUniqueTitles(
            $movies
        );


    /*
     * ========================================================
     * SMART LATEST SORT
     * ========================================================
     */

    $movies =
        sairamWatchmodeSortSmart(
            $movies,
            'latest'
        );


    /*
     * ========================================================
     * FINAL LIMIT
     * ========================================================
     */

    return array_slice(
        $movies,
        0,
        $limit
    );
}

/* ============================================================
   SEARCH WATCHMODE TITLES
   ============================================================ */

function sairamWatchmodeSearchTitles(
    $query
) {

    $query =
        trim(
            (string) $query
        );


    if (
        $query === ''
    ) {
        return [];
    }


    $safeKey =
        preg_replace(
            '/[^a-zA-Z0-9_\-]/',
            '_',
            strtolower($query)
        );


    $data =
        sairamWatchmodeRequest(
            'search',
            [
                'search_field' =>
                    'name',

                'search_value' =>
                    $query
            ],
            'search_'
            . $safeKey,
            true
        );


    if (
        isset(
            $data['title_results']
        )
        &&
        is_array(
            $data['title_results']
        )
    ) {

        return
            $data['title_results'];
    }


    if (
        is_array($data)
        &&
        isset($data[0])
    ) {

        return $data;
    }


    return [];
}


/* ============================================================
   FIND PRIORITY JIOHOTSTAR TITLES
   ============================================================ */

function sairamWatchmodePriorityJioTitles()
{

    $queries = [

        'Bigg Boss Telugu',
        'Bigg Boss Telugu Season 10',
        'Adivaram with Star Maa Pariwar',
        'Star Maa Pariwar'

    ];


    $found = [];


    foreach (
        $queries as $query
    ) {

        $results =
            sairamWatchmodeSearchTitles(
                $query
            );


        foreach (
            $results as $result
        ) {

            if (
                !is_array($result)
            ) {
                continue;
            }


            $id =
                (int) (
                    $result['id']
                    ??
                    $result['watchmode_id']
                    ??
                    0
                );


            if (
                $id <= 0
            ) {
                continue;
            }


            $found[$id] =
                $result;
        }
    }


    return array_values(
        $found
    );
}


/* ============================================================
   OTT MOVIES
   ============================================================ */

function sairamWatchmodeOttMovies(
    $limit = 15
) {

    $limit =
        max(
            1,
            min(
                50,
                (int) $limit
            )
        );


    /*
     * ---------------------------------------------------------
     * 1. Find streaming provider IDs dynamically.
     * ---------------------------------------------------------
     */

    $jioHotstarIds =
        sairamWatchmodeFindSourceIds(
            [
                'jiohotstar',
                'hotstar',
                'disney+ hotstar',
                'disney hotstar'
            ]
        );


    $primeIds =
        sairamWatchmodeFindSourceIds(
            [
                'amazon prime',
                'prime video',
                'amazon video'
            ]
        );


    $netflixIds =
        sairamWatchmodeFindSourceIds(
            [
                'netflix'
            ]
        );


    $primeNetflixIds =
        array_values(
            array_unique(
                array_merge(
                    $primeIds,
                    $netflixIds
                )
            )
        );


    $movies = [];


    /* ========================================================
       2. JIOHOTSTAR TELUGU TV CONTENT
       ======================================================== */

    if (
        !empty($jioHotstarIds)
    ) {

        $params = [

            'types' =>
                'tv_series,tv_special,tv_miniseries',

            'regions' =>
                SAIRAM_WATCHMODE_REGION,

            'source_ids' =>
                implode(
                    ',',
                    $jioHotstarIds
                ),

            'languages' =>
                'te',

            'sort_by' =>
                'release_date_desc',

            'page' =>
                1,

            'limit' =>
                50

        ];


        $data =
            sairamWatchmodeRequest(
                'list-titles',
                $params,
                'ott_jiohotstar_telugu_'
                . SAIRAM_WATCHMODE_REGION,
                true
            );


        if (
            !empty($data['titles'])
            &&
            is_array(
                $data['titles']
            )
        ) {

            foreach (
                $data['titles'] as $show
            ) {

                $enriched =
                    sairamWatchmodeEnrichMovie(
                        $show,
                        true
                    );


                if (
                    $enriched === null
                ) {
                    continue;
                }


                $enriched['_sairam_ott_group'] =
                    'JioHotstar';


                $movies[] =
                    $enriched;
            }
        }


        /*
         * Priority searches.
         *
         * Only titles actually present in Watchmode
         * are added.
         */

        $priority =
            sairamWatchmodePriorityJioTitles();


        foreach (
            $priority as $candidate
        ) {

            $id =
                (int) (
                    $candidate['id']
                    ??
                    $candidate['watchmode_id']
                    ??
                    0
                );


            if (
                $id <= 0
            ) {
                continue;
            }


            $details =
                sairamWatchmodeTitleDetails(
                    $id,
                    true
                );


            if (
                empty($details)
            ) {
                continue;
            }


            $sources =
                $details['sources']
                ?? [];


            $hasJio =
                false;


            foreach (
                $sources as $source
            ) {

                $sourceId =
                    (int) (
                        $source['source_id']
                        ?? 0
                    );


                if (
                    in_array(
                        $sourceId,
                        $jioHotstarIds,
                        true
                    )
                ) {

                    $hasJio = true;

                    break;
                }
            }


            if (
                !$hasJio
            ) {
                continue;
            }


            $details['id'] =
                $id;


            $details['_sairam_ott_group'] =
                'JioHotstar';


            $enriched =
                sairamWatchmodeEnrichMovie(
                    $details,
                    true
                );


            if (
                $enriched !== null
            ) {

                $movies[] =
                    $enriched;
            }
        }
    }


    /* ========================================================
       3. NETFLIX + PRIME VIDEO MOVIES
       ======================================================== */

    if (
        !empty($primeNetflixIds)
    ) {

        $startDate =
            date(
                'Ymd',
                strtotime(
                    '-365 days'
                )
            );


        $endDate =
            date(
                'Ymd'
            );


        $params = [

            'types' =>
                'movie',

            'regions' =>
                SAIRAM_WATCHMODE_REGION,

            'source_ids' =>
                implode(
                    ',',
                    $primeNetflixIds
                ),

            'languages' =>
                'te,en',

            'release_date_start' =>
                $startDate,

            'release_date_end' =>
                $endDate,

            'sort_by' =>
                'release_date_desc',

            'page' =>
                1,

            'limit' =>
                50

        ];


        $data =
            sairamWatchmodeRequest(
                'list-titles',
                $params,
                'ott_prime_netflix_'
                . SAIRAM_WATCHMODE_REGION,
                true
            );


        if (
            !empty($data['titles'])
            &&
            is_array(
                $data['titles']
            )
        ) {

            foreach (
                $data['titles'] as $movie
            ) {

                $enriched =
                    sairamWatchmodeEnrichMovie(
                        $movie,
                        true
                    );


                if (
                    $enriched === null
                ) {
                    continue;
                }


                /*
                 * Keep only preferred genres.
                 */

                $preferred =
                    sairamWatchmodeMovieHasGenre(
                        $enriched,
                        [
                            'Action',
                            'Thriller',
                            'Science Fiction',
                            'Adventure',
                            'Crime',
                            'Horror',
                            'Sport'
                        ]
                    );


                $text =
                    sairamWatchmodeText(
                        $enriched
                    );


                $keywordMatch = false;


                $keywords = [

                    'fight',
                    'fighting',
                    'martial',
                    'boxing',
                    'mma',
                    'racing',
                    'race',
                    'car',
                    'motorsport',
                    'formula',
                    'speed',
                    'driver',
                    'spy',
                    'alien',
                    'superhero'

                ];


                foreach (
                    $keywords as $keyword
                ) {

                    if (
                        strpos(
                            $text,
                            $keyword
                        ) !== false
                    ) {

                        $keywordMatch = true;

                        break;
                    }
                }


                if (
                    !$preferred
                    &&
                    !$keywordMatch
                ) {
                    continue;
                }


                $enriched['_sairam_ott_group'] =
                    'Prime Video / Netflix';


                $movies[] =
                    $enriched;
            }
        }
    }


    /* ========================================================
       4. REMOVE DUPLICATES
       ======================================================== */

    $movies =
        sairamWatchmodeUniqueTitles(
            $movies
        );


    /* ========================================================
       5. SMART SORT
       ======================================================== */

    $movies =
        sairamWatchmodeSortSmart(
            $movies,
            'ott'
        );


    /*
     * Put JioHotstar priority Telugu shows
     * before generic OTT movie results.
     */

    $jio =
        [];

    $other =
        [];


    foreach (
        $movies as $movie
    ) {

        if (
            (
                $movie['_sairam_ott_group']
                ??
                ''
            )
            === 'JioHotstar'
        ) {

            $jio[] =
                $movie;

        } else {

            $other[] =
                $movie;
        }
    }


    /*
     * JioHotstar first, then Prime/Netflix.
     */

    $movies =
        array_merge(
            $jio,
            $other
        );


    return array_slice(
        $movies,
        0,
        $limit
    );
}


/* ============================================================
   TRAILER IMAGE
   ============================================================ */

function sairamWatchmodeTrailerImage(
    $movie
) {

    if (
        !is_array($movie)
    ) {

        return
            sairamWatchmodePoster(
                []
            );
    }


    $fields = [

        'backdrop_url',
        'backdrop',
        'landscape_url',
        'image_url',
        'poster_url'

    ];


    foreach (
        $fields as $field
    ) {

        if (
            !empty($movie[$field])
            &&
            is_string($movie[$field])
        ) {

            return
                trim(
                    $movie[$field]
                );
        }
    }


    return
        sairamWatchmodePoster(
            $movie
        );
}


/* ============================================================
   WATCHMODE TRAILER EMBED URL
   ============================================================ */

function sairamWatchmodeTrailerEmbedUrl($movie)
{
    if (!is_array($movie)) {
        return '';
    }

    /*
     * Watchmode title details officially provide:
     *
     * trailer = YouTube trailer URL
     *
     * Example:
     * https://www.youtube.com/watch?v=XXXXXXXX
     */

    $trailerUrl = trim(
        (string) (
            $movie['trailer']
            ?? $movie['trailer_url']
            ?? $movie['youtube_trailer']
            ?? $movie['youtube_url']
            ?? $movie['video_url']
            ?? ''
        )
    );

    if ($trailerUrl === '') {
        return '';
    }


    /*
     * Already an embed URL
     */
    if (
        strpos(
            $trailerUrl,
            'youtube-nocookie.com/embed/'
        ) !== false
        ||
        strpos(
            $trailerUrl,
            'youtube.com/embed/'
        ) !== false
    ) {

        /*
         * Make sure autoplay works inside modal.
         */
        if (strpos($trailerUrl, 'autoplay=') === false) {

            $separator =
                strpos($trailerUrl, '?') !== false
                    ? '&'
                    : '?';

            $trailerUrl .=
                $separator .
                'autoplay=1&rel=0';
        }

        return $trailerUrl;
    }


    /*
     * Extract YouTube video ID
     */

    $youtubeId = '';


    /*
     * Standard:
     * https://www.youtube.com/watch?v=VIDEO_ID
     */
    if (
        preg_match(
            '~youtube\.com/watch\?v=([A-Za-z0-9_-]{6,})~i',
            $trailerUrl,
            $match
        )
    ) {

        $youtubeId =
            $match[1];
    }


    /*
     * Short URL:
     * https://youtu.be/VIDEO_ID
     */
    if (
        empty($youtubeId)
        &&
        preg_match(
            '~youtu\.be/([A-Za-z0-9_-]{6,})~i',
            $trailerUrl,
            $match
        )
    ) {

        $youtubeId =
            $match[1];
    }


    /*
     * YouTube shorts
     */
    if (
        empty($youtubeId)
        &&
        preg_match(
            '~youtube\.com/shorts/([A-Za-z0-9_-]{6,})~i',
            $trailerUrl,
            $match
        )
    ) {

        $youtubeId =
            $match[1];
    }


    /*
     * If a valid YouTube ID was found,
     * return privacy-enhanced embed.
     */
    if (!empty($youtubeId)) {

        return
            'https://www.youtube-nocookie.com/embed/' .
            rawurlencode($youtubeId) .
            '?autoplay=1&rel=0';
    }


    /*
     * If it is another valid HTTPS video URL,
     * return it directly.
     */
    if (
        filter_var(
            $trailerUrl,
            FILTER_VALIDATE_URL
        )
        &&
        stripos(
            $trailerUrl,
            'https://'
        ) === 0
    ) {

        return $trailerUrl;
    }


    return '';
}


/* ============================================================
   LATEST TRAILERS
   ============================================================
   Curated automatically from Watchmode:

   1. Latest Telugu movies
   2. Marvel / Superhero movies
   3. English Action / Sci-Fi / Horror / Adventure
   4. Bigg Boss Telugu Season 10
   5. JioHotstar Telugu TV content

   No manually hardcoded trailer URLs.
   ============================================================ */

/* ============================================================
   LATEST TRAILERS
   ============================================================ */

function sairamWatchmodeLatestTrailers(
    $limit = 10,
    $tab = 'popular'
) {

    $limit = max(
        1,
        min(30, (int) $limit)
    );

    $tab = strtolower(
        trim((string) $tab)
    );

    $allowedTabs = [
        'popular',
        'streaming',
        'ontv',
        'rent',
        'theaters'
    ];

    if (!in_array($tab, $allowedTabs, true)) {
        $tab = 'popular';
    }

    /*
     * --------------------------------------------------------
     * CACHE
     * --------------------------------------------------------
     */

    $cacheKey =
        'latest_trailers_curated_v5_'
        . $tab
        . '_'
        . SAIRAM_WATCHMODE_REGION
        . '_'
        . $limit;

    /*
     * --------------------------------------------------------
     * DATE RANGE
     * --------------------------------------------------------
     */

    $startDate = date(
        'Ymd',
        strtotime('-365 days')
    );

    $endDate = date('Ymd');

    $movies = [];

    /*
     * ========================================================
     * ADD TRAILER HELPER
     * ========================================================
     */

    $addTrailer = function (
        $movie,
        $category = ''
    ) use (&$movies) {

        if (!is_array($movie)) {
            return;
        }

        $id = (int) (
            $movie['id']
            ??
            $movie['watchmode_id']
            ??
            0
        );

        if ($id <= 0) {
            return;
        }

        /*
         * Get complete Watchmode title details.
         */

        try {

            $details =
                sairamWatchmodeTitleDetails(
                    $id
                );

        } catch (Throwable $e) {

            $details = [];
        }

        if (
            is_array($details)
            &&
            !empty($details)
        ) {

            $movie =
                array_merge(
                    $movie,
                    $details
                );
        }

        /*
         * Actual Watchmode trailer.
         */

        $trailerUrl = trim(
            (string) (
                $movie['trailer']
                ??
                $movie['trailer_url']
                ??
                $movie['youtube_trailer']
                ??
                ''
            )
        );

        /*
         * Do not create fake trailer cards.
         */

        if ($trailerUrl === '') {
            return;
        }

        /*
         * Trailer thumbnail.
         */

        $thumbnail = trim(
            (string) (
                $movie['trailer_thumbnail']
                ??
                $movie['backdrop']
                ??
                $movie['backdrop_url']
                ??
                $movie['poster_url']
                ??
                $movie['poster']
                ??
                ''
            )
        );

        $movie['_sairam_trailer_url'] =
            $trailerUrl;

        $movie['_sairam_trailer_thumbnail'] =
            $thumbnail;

        $movie['_sairam_trailer_category'] =
            $category;

        /*
         * Prevent duplicates.
         */

        foreach ($movies as $existing) {

            $existingId = (int) (
                $existing['id']
                ??
                $existing['watchmode_id']
                ??
                0
            );

            if ($existingId === $id) {
                return;
            }
        }

        $movies[] = $movie;
    };


    /*
     * ========================================================
     * 1. LATEST TELUGU MOVIES
     * ========================================================
     */

    $teluguParams = [

        'types' =>
            'movie',

        'regions' =>
            SAIRAM_WATCHMODE_REGION,

        'languages' =>
            'te',

        'release_date_start' =>
            $startDate,

        'release_date_end' =>
            $endDate,

        'sort_by' =>
            'release_date_desc',

        'page' =>
            1,

        'limit' =>
            50
    ];

    $teluguData =
        sairamWatchmodeRequest(
            'list-titles',
            $teluguParams,
            'latest_trailers_telugu_v5_'
            . SAIRAM_WATCHMODE_REGION,
            true
        );

    if (
        is_array($teluguData)
        &&
        !empty($teluguData['titles'])
        &&
        is_array($teluguData['titles'])
    ) {

        foreach (
            $teluguData['titles'] as $movie
        ) {

            if (!is_array($movie)) {
                continue;
            }

            if (
                isset($movie['type'])
                &&
                strtolower(
                    (string) $movie['type']
                ) !== 'movie'
            ) {
                continue;
            }

            $movie['_sairam_language'] =
                'te';

            $addTrailer(
                $movie,
                'Latest Telugu Movie'
            );

            if (
                count($movies) >= 6
            ) {
                break;
            }
        }
    }


    /*
     * ========================================================
     * 2. ENGLISH MARVEL / SUPERHERO / ACTION / HORROR
     * ========================================================
     */

    $englishParams = [

        'types' =>
            'movie',

        'regions' =>
            SAIRAM_WATCHMODE_REGION,

        'languages' =>
            'en',

        'release_date_start' =>
            $startDate,

        'release_date_end' =>
            $endDate,

        'sort_by' =>
            'release_date_desc',

        'page' =>
            1,

        'limit' =>
            100
    ];

    $englishData =
        sairamWatchmodeRequest(
            'list-titles',
            $englishParams,
            'latest_trailers_english_v5_'
            . SAIRAM_WATCHMODE_REGION,
            true
        );

    if (
        is_array($englishData)
        &&
        !empty($englishData['titles'])
        &&
        is_array($englishData['titles'])
    ) {

        foreach (
            $englishData['titles'] as $movie
        ) {

            if (!is_array($movie)) {
                continue;
            }

            if (
                isset($movie['type'])
                &&
                strtolower(
                    (string) $movie['type']
                ) !== 'movie'
            ) {
                continue;
            }

            try {

                $temp =
                    sairamWatchmodeEnrichMovie(
                        $movie,
                        false
                    );

            } catch (Throwable $e) {

                $temp = null;
            }

            if (!is_array($temp)) {
                continue;
            }

            $text =
                strtolower(
                    sairamWatchmodeText(
                        $temp
                    )
                );

            /*
             * Marvel / superhero keywords.
             */

            $marvelWords = [

                'marvel',
                'avenger',
                'avengers',
                'spider-man',
                'spiderman',
                'batman',
                'superman',
                'deadpool',
                'x-men',
                'x men',
                'venom',
                'fantastic four',
                'thor',
                'aquaman',
                'black panther',
                'doctor strange',
                'captain america',
                'guardians of the galaxy',
                'superhero',
                'super hero'

            ];

            /*
             * Action keywords.
             */

            $actionWords = [

                'action',
                'fighting',
                'fight',
                'martial arts',
                'warrior',
                'assassin',
                'combat',
                'boxing',
                'mma',
                'gunfight'

            ];

            /*
             * Horror keywords.
             */

            $horrorWords = [

                'horror',
                'ghost',
                'haunted',
                'demon',
                'possession',
                'vampire',
                'zombie',
                'supernatural'

            ];

            $isMarvel = false;
            $isAction = false;
            $isHorror = false;

            foreach ($marvelWords as $word) {

                if (
                    strpos(
                        $text,
                        $word
                    ) !== false
                ) {

                    $isMarvel = true;
                    break;
                }
            }

            foreach ($actionWords as $word) {

                if (
                    strpos(
                        $text,
                        $word
                    ) !== false
                ) {

                    $isAction = true;
                    break;
                }
            }

            foreach ($horrorWords as $word) {

                if (
                    strpos(
                        $text,
                        $word
                    ) !== false
                ) {

                    $isHorror = true;
                    break;
                }
            }

            /*
             * Also check actual Watchmode genres.
             */

            try {

                if (
                    sairamWatchmodeMovieHasGenre(
                        $temp,
                        ['Action']
                    )
                ) {
                    $isAction = true;
                }

                if (
                    sairamWatchmodeMovieHasGenre(
                        $temp,
                        ['Horror']
                    )
                ) {
                    $isHorror = true;
                }

                if (
                    sairamWatchmodeMovieHasGenre(
                        $temp,
                        [
                            'Science Fiction',
                            'Adventure'
                        ]
                    )
                ) {

                    $isAction = true;
                }

            } catch (Throwable $e) {
                // Keep keyword matching.
            }

            if (
                !$isMarvel
                &&
                !$isAction
                &&
                !$isHorror
            ) {
                continue;
            }

            if ($isMarvel) {

                $category =
                    'Marvel / Superhero';

            } elseif ($isHorror) {

                $category =
                    'Latest Horror Movie';

            } else {

                $category =
                    'Latest Action Movie';
            }

            $temp['_sairam_language'] =
                'en';

            $addTrailer(
                $temp,
                $category
            );

            if (
                count($movies) >= 14
            ) {
                break;
            }
        }
    }


    /*
     * ========================================================
     * 3. BIGG BOSS TELUGU SEASON 10
     * ========================================================
     *
     * We search Watchmode instead of hardcoding a video URL.
     * Season 10 is verified through Watchmode season data.
     */

    $biggBossQueries = [

        'Bigg Boss Telugu Season 10',
        'Bigg Boss Telugu'

    ];

    $biggBossAdded = false;

    foreach (
        $biggBossQueries as $query
    ) {

        if ($biggBossAdded) {
            break;
        }

        $searchData =
            sairamWatchmodeSearchTitles(
                $query
            );

        if (
            empty($searchData)
            ||
            !is_array($searchData)
        ) {
            continue;
        }

        foreach (
            $searchData as $result
        ) {

            if (!is_array($result)) {
                continue;
            }

            $id = (int) (
                $result['id']
                ??
                $result['watchmode_id']
                ??
                0
            );

            if ($id <= 0) {
                continue;
            }

            $resultName =
                strtolower(
                    trim(
                        (string) (
                            $result['name']
                            ??
                            $result['title']
                            ??
                            ''
                        )
                    )
                );

            if (
                strpos(
                    $resultName,
                    'bigg boss'
                ) === false
            ) {
                continue;
            }

            /*
             * Request seasons along with details.
             */

            try {

                $details =
                    sairamWatchmodeTitleDetails(
                        $id,
                        false,
                        'seasons'
                    );

            } catch (Throwable $e) {

                $details = [];
            }

            if (
                !is_array($details)
                ||
                empty($details)
            ) {
                continue;
            }

            /*
             * Verify Season 10.
             */

            $hasSeason10 = false;

            if (
                !empty($details['seasons'])
                &&
                is_array($details['seasons'])
            ) {

                foreach (
                    $details['seasons'] as $season
                ) {

                    if (!is_array($season)) {
                        continue;
                    }

                    $seasonNumber =
                        (int) (
                            $season['number']
                            ??
                            0
                        );

                    if (
                        $seasonNumber === 10
                    ) {

                        $hasSeason10 = true;
                        break;
                    }
                }
            }

            /*
             * Do not label another season as Season 10.
             */

            if (!$hasSeason10) {
                continue;
            }

            $details['_sairam_language'] =
                'te';

            $details['_sairam_biggboss_season'] =
                10;

            $addTrailer(
                $details,
                'Bigg Boss Telugu Season 10'
            );

            $biggBossAdded = true;

            break;
        }
    }


    /*
     * ========================================================
     * 4. PRIORITY SORT
     * ========================================================
     */

    usort(
        $movies,
        function (
            $a,
            $b
        ) {

            $categoryA =
                strtolower(
                    (string) (
                        $a['_sairam_trailer_category']
                        ??
                        ''
                    )
                );

            $categoryB =
                strtolower(
                    (string) (
                        $b['_sairam_trailer_category']
                        ??
                        ''
                    )
                );

            $priorityA = 0;
            $priorityB = 0;

            /*
             * Bigg Boss first.
             */

            if (
                strpos(
                    $categoryA,
                    'bigg boss'
                ) !== false
            ) {
                $priorityA += 1000;
            }

            if (
                strpos(
                    $categoryB,
                    'bigg boss'
                ) !== false
            ) {
                $priorityB += 1000;
            }

            /*
             * Marvel / Superhero second.
             */

            if (
                strpos(
                    $categoryA,
                    'marvel'
                ) !== false
            ) {
                $priorityA += 500;
            }

            if (
                strpos(
                    $categoryB,
                    'marvel'
                ) !== false
            ) {
                $priorityB += 500;
            }

            if (
                $priorityA !== $priorityB
            ) {

                return
                    $priorityB
                    <=>
                    $priorityA;
            }

            /*
             * Latest release date.
             */

            $dateA =
                (string) (
                    $a['release_date']
                    ??
                    ''
                );

            $dateB =
                (string) (
                    $b['release_date']
                    ??
                    ''
                );

            return strcmp(
                $dateB,
                $dateA
            );
        }
    );

    return array_slice(
        $movies,
        0,
        $limit
    );
}