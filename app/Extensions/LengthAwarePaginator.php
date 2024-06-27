<?php
namespace App\Extensions;
use Illuminate\Support\Collection;

final class LengthAwarePaginator extends \Illuminate\Pagination\LengthAwarePaginator
{
    public function toArray(): array
    {
        return [
            'links' => $this->customLinksCollection(),
            'current_page' => $this->currentPage(),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }

    public function customLinksCollection(): Collection
    {
        $onEachSide = 2;
        $currentPage = $this->currentPage();
        $total = $this->total();
        $lastPage = $this->lastPage();

        $links = collect();

        $sliceLinks = [];

        if (isset($total, $this->perPage) === true)
        {
            $sliceLinks = range(1, ceil($total / $this->perPage));

            if (isset($currentPage, $onEachSide) === true)
            {
                if (($onEachSide = floor($onEachSide / 2) * 2 + 1) >= 1)
                {
                    $sliceLinks = array_slice(
                        $sliceLinks,
                        max(0, min(count($sliceLinks) - $onEachSide, $currentPage - ceil($onEachSide / 2))),
                        $onEachSide
                    );
                }
            }
        }

        if ($currentPage > 1) {
            $links->push([
                "active" => false,
                "label" => "first",
            ]);
            $links->push([
                "active" => false,
                "label" => "prev",
            ]);
        }

        foreach ($sliceLinks as $link) {
            $links->push([
                "active" => (int) $link === $currentPage,
                "label" => (int) $link,
            ]);
        }

        if ($currentPage < $lastPage && $this->perPage < $total) {
            $links->push([
                "active" => false,
                "label" => "next",
            ]);
            $links->push([
                "active" => false,
                "label" => "last",
            ]);
        }

        return $links;
    }
}
