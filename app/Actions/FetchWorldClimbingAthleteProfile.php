<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final readonly class FetchWorldClimbingAthleteProfile
{
    private const string BASE_URL = 'https://www.worldclimbing.com/athlete';

    /**
     * @return array<string, mixed>|null
     *
     * @throws ConnectionException
     */
    public function handle(int $athleteId, string $firstname, string $lastname): ?array
    {
        $slug = Str::slug($firstname.' '.$lastname);
        $url = self::BASE_URL.'/'.$athleteId.'/'.$slug;

        $response = Http::withHeaders([
            'RSC' => '1',
            'Next-Url' => '/athlete/'.$athleteId.'/'.$slug,
        ])->get($url);

        if ($response->failed()) {
            return null;
        }

        return $this->parseRscResponse($response->body());
    }

    /**
     * @return array<string, mixed>|null
     */
    private function parseRscResponse(string $body): ?array
    {
        foreach (explode("\n", $body) as $line) {
            if (! preg_match('/^\w+:/', $line)) {
                continue;
            }

            if (! str_contains($line, '"athlete":{')) {
                continue;
            }

            $data = $this->extractAthleteData($line);
            dd($data);
            if ($data !== null) {
                return $data;
            }
        }

        return null;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function extractAthleteData(string $line): ?array
    {
        // Use '8bit' encoding to operate on raw bytes, avoiding multi-byte offset issues
        $startPos = mb_strpos($line, '"athlete":', encoding: '8bit');

        if ($startPos === false) {
            return null;
        }

        $objectStart = mb_strpos($line, '{', $startPos, '8bit');

        if ($objectStart === false) {
            return null;
        }

        $depth = 0;
        $length = mb_strlen($line, '8bit');

        for ($i = $objectStart; $i < $length; $i++) {
            if ($line[$i] === '{') {
                $depth++;
            } elseif ($line[$i] === '}') {
                $depth--;

                if ($depth === 0) {
                    $athleteJson = mb_substr($line, $objectStart, $i - $objectStart + 1, '8bit');

                    return json_decode($athleteJson, true);
                }
            }
        }

        return null;
    }
}
