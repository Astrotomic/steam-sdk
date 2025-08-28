<?php

namespace Astrotomic\SteamSdk;

use Closure;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Stringable;
use xPaw\Steam\SteamID as xPawSteamID;

class SteamID implements Stringable
{
    public readonly xPawSteamID $id;

    public static function make(string|int $id): self
    {
        return new self($id);
    }

    public function __construct(string|int $id)
    {
        if (is_numeric($id) && Str::isMatch('/^\d+$/', $id)) {
            $id = (int) $id;
        }

        $id = collect([
            function (string|int $id): ?xPawSteamID {
                return new xPawSteamID($id);
            },
            function (string|int $id): ?xPawSteamID {
                if (is_int($id)) {
                    return xPawSteamID::FromAccountID($id);
                }

                return null;
            },
            function (string|int $id): ?xPawSteamID {
                if (is_string($id) && str_starts_with($id, 'steam:')) {
                    return new xPawSteamID(hexdec(Str::after($id, 'steam:')));
                }

                return null;
            },
            function (string|int $id): ?xPawSteamID {
                if (is_string($id)) {
                    return (new xPawSteamID)->SetFromCsgoFriendCode($id);
                }

                return null;
            },
            function (string|int $id): ?xPawSteamID {
                if (is_string($id) && filter_var($id, FILTER_VALIDATE_URL)) {
                    return app(SteamConnector::class)->resolveVanityUrl($id);
                }

                return null;
            },
        ])
            ->map(fn (Closure $resolver) => rescue(
                callback: fn () => $resolver($id),
                report: false,
            ))
            ->filter()
            ->first(fn (xPawSteamID $id) => $id->IsValid());

        if ($id === null) {
            throw new InvalidArgumentException('Provided SteamID is invalid.');
        }

        $this->id = $id;
    }

    public function toAccountID(): int
    {
        return $this->id->GetAccountID();
    }

    public function toSteamID(): int
    {
        return $this->id->ConvertToUInt64();
    }

    public function toSteam2ID(): string
    {
        return $this->id->RenderSteam2();
    }

    public function toSteam3ID(): string
    {
        return $this->id->RenderSteam3();
    }

    public function toSteam3Hex(): string
    {
        return 'steam:'.dechex($this->toSteamID());
    }

    public function toCsgoFriendCode(): string
    {
        return $this->id->RenderCsgoFriendCode();
    }

    public function toSteamInviteCode(): string
    {
        return $this->id->RenderSteamInvite();
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}
