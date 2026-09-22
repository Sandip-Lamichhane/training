<?php

/**
 * module/StudentSearch.php
 *
 * Implements classical Computer Science Searching Algorithms for the Student Management System.
 * 
 * Algorithms implemented:
 * 1. Binary Search (Divide and Conquer, O(log n))
 *    - Binary Search by Student ID (numeric)
 *    - Binary Search by Student Name (lexicographical with range expansion)
 * 2. Linear Search (Sequential Search, O(n))
 *    - Multi-field sequential search
 */

class StudentSearch
{
    /**
     * Perform Binary Search by Student ID
     * 
     * Precondition: The array must be sorted by ID in ascending order.
     * Time Complexity:
     *   - Best Case: O(1) [Target is at the exact middle]
     *   - Average Case: O(log n)
     *   - Worst Case: O(log n)
     * Space Complexity: O(1) [Iterative implementation]
     *
     * @param array $students Array of student records
     * @param int $targetId Numeric student ID to search for
     * @return array [ 'results' => array, 'comparisons' => int ]
     */
    public static function binarySearchById(array $students, int $targetId): array
    {
        // Ensure the dataset is sorted by ID ascending
        usort($students, function ($a, $b) {
            return (int)$a['id'] <=> (int)$b['id'];
        });

        $low = 0;
        $high = count($students) - 1;
        $comparisons = 0;
        $results = [];

        while ($low <= $high) {
            $comparisons++;
            // Calculate midpoint safely avoiding integer overflow
            $mid = intdiv($low + $high, 2);
            $currentId = (int)$students[$mid]['id'];

            if ($currentId === $targetId) {
                // Exact match found at midpoint
                $results[] = $students[$mid];
                break;
            } elseif ($currentId < $targetId) {
                // Target is in the right half: discard left half
                $low = $mid + 1;
            } else {
                // Target is in the left half: discard right half
                $high = $mid - 1;
            }
        }

        return [
            'results' => $results,
            'comparisons' => $comparisons,
        ];
    }

    /**
     * Perform Binary Search by Student Name
     *
     * Precondition: Array sorted alphabetically by name.
     * Locates a matching prefix/name in O(log n), then scans adjacent items for multiple matches.
     *
     * Time Complexity: O(log n + k) where k is the number of matching records
     *
     * @param array $students Array of student records
     * @param string $targetName Target name/prefix
     * @return array [ 'results' => array, 'comparisons' => int ]
     */
    public static function binarySearchByName(array $students, string $targetName): array
    {
        $targetName = strtolower(trim($targetName));
        $len = strlen($targetName);

        if ($len === 0) {
            return ['results' => $students, 'comparisons' => 0];
        }

        // Sort students alphabetically by first_name + last_name
        usort($students, function ($a, $b) {
            $nameA = strtolower($a['first_name'] . ' ' . $a['last_name']);
            $nameB = strtolower($b['first_name'] . ' ' . $b['last_name']);
            return strcmp($nameA, $nameB);
        });

        $low = 0;
        $high = count($students) - 1;
        $comparisons = 0;
        $matchIndex = -1;

        // Binary Search phase to find an initial match
        while ($low <= $high) {
            $comparisons++;
            $mid = intdiv($low + $high, 2);

            $fullName = strtolower($students[$mid]['first_name'] . ' ' . $students[$mid]['last_name']);
            $prefix = substr($fullName, 0, $len);

            $cmp = strcmp($prefix, $targetName);

            if ($cmp === 0) {
                $matchIndex = $mid;
                break;
            } elseif ($cmp < 0) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }

        $results = [];

        if ($matchIndex !== -1) {
            // Expand left to collect all matching adjacent items
            $left = $matchIndex;
            while ($left >= 0) {
                $fullName = strtolower($students[$left]['first_name'] . ' ' . $students[$left]['last_name']);
                if (substr($fullName, 0, $len) === $targetName || str_contains($fullName, $targetName)) {
                    $results[] = $students[$left];
                    $left--;
                    $comparisons++;
                } else {
                    break;
                }
            }

            // Reverse to restore original alphabetical order from left scan
            $results = array_reverse($results);

            // Expand right to collect all matching adjacent items
            $right = $matchIndex + 1;
            while ($right < count($students)) {
                $fullName = strtolower($students[$right]['first_name'] . ' ' . $students[$right]['last_name']);
                if (substr($fullName, 0, $len) === $targetName || str_contains($fullName, $targetName)) {
                    $results[] = $students[$right];
                    $right++;
                    $comparisons++;
                } else {
                    break;
                }
            }
        }

        return [
            'results' => $results,
            'comparisons' => $comparisons,
        ];
    }

    /**
     * Perform Linear Search (Sequential Search)
     *
     * Iterates sequentially element by element through the student list.
     * Evaluates query against multiple fields (name, email, phone, parent name, id).
     *
     * Time Complexity:
     *   - Best Case: O(1) [Match is the first element]
     *   - Average Case: O(n)
     *   - Worst Case: O(n) [Must inspect all n elements]
     * Space Complexity: O(1)
     *
     * @param array $students Array of student records
     * @param string $query Keyword to search
     * @return array [ 'results' => array, 'comparisons' => int ]
     */
    public static function linearSearch(array $students, string $query): array
    {
        $query = strtolower(trim($query));
        $comparisons = 0;
        $results = [];

        $total = count($students);
        for ($i = 0; $i < $total; $i++) {
            $comparisons++;
            $s = $students[$i];

            $fullName   = strtolower($s['first_name'] . ' ' . $s['last_name']);
            $email      = strtolower($s['email'] ?? '');
            $phone      = strtolower($s['phone'] ?? '');
            $parentName = strtolower($s['parents_name'] ?? '');
            $idStr      = (string)$s['id'];

            if (
                str_contains($fullName, $query) ||
                str_contains($email, $query) ||
                str_contains($phone, $query) ||
                str_contains($parentName, $query) ||
                str_contains($idStr, $query)
            ) {
                $results[] = $s;
            }
        }

        return [
            'results' => $results,
            'comparisons' => $comparisons,
        ];
    }

    /**
     * Unified search dispatcher with profiling and metrics
     *
     * @param array $students All student records
     * @param string $query Search query string
     * @param string $algorithm 'binary' | 'linear'
     * @return array Execution report including matches and benchmark statistics
     */
    public static function search(array $students, string $query, string $algorithm = 'binary'): array
    {
        $startTime = microtime(true);
        $cleanQuery = trim($query);

        if (empty($cleanQuery)) {
            return [
                'results'          => $students,
                'algorithm'        => 'None',
                'time_complexity'  => 'N/A',
                'comparisons'      => 0,
                'time_ms'          => 0,
                'records_searched' => count($students),
                'query'            => '',
                'strategy_note'    => 'Displaying all records without filtering',
            ];
        }

        $results = [];
        $comparisons = 0;
        $complexity = '';
        $algoName = '';
        $strategyNote = '';

        if ($algorithm === 'linear') {
            // Linear Search
            $algoName = 'Linear Search';
            $complexity = 'O(n)';
            $strategyNote = 'Sequential scan checking each record across all fields (name, email, phone, parent, ID)';
            $searchOutcome = self::linearSearch($students, $cleanQuery);
            $results = $searchOutcome['results'];
            $comparisons = $searchOutcome['comparisons'];
        } else {
            // Binary Search
            $algoName = 'Binary Search';
            $complexity = 'O(log n)';

            // Check if query is a numeric ID or Registration Code (e.g. STD-0002 or 2)
            $isIdSearch = false;
            $numericId = 0;

            if (is_numeric($cleanQuery)) {
                $isIdSearch = true;
                $numericId = (int)$cleanQuery;
            } elseif (preg_match('/^STD-0*([0-9]+)$/i', $cleanQuery, $matches)) {
                $isIdSearch = true;
                $numericId = (int)$matches[1];
            }

            if ($isIdSearch) {
                $strategyNote = "Divide & conquer on sorted numeric IDs (searching for Student ID #{$numericId})";
                $searchOutcome = self::binarySearchById($students, $numericId);
                $results = $searchOutcome['results'];
                $comparisons = $searchOutcome['comparisons'];
            } else {
                $strategyNote = "Divide & conquer on lexicographically sorted Student Names (prefix match for '{$cleanQuery}')";
                $searchOutcome = self::binarySearchByName($students, $cleanQuery);
                $results = $searchOutcome['results'];
                $comparisons = $searchOutcome['comparisons'];

                // If no direct binary name match found, fallback to linear search to check email/parent fields
                if (empty($results)) {
                    $linearFallback = self::linearSearch($students, $cleanQuery);
                    if (!empty($linearFallback['results'])) {
                        $results = $linearFallback['results'];
                        $comparisons += $linearFallback['comparisons'];
                        $strategyNote .= " + fallback scan across contact fields";
                    }
                }
            }
        }

        $endTime = microtime(true);
        $timeMs = round(($endTime - $startTime) * 1000, 4);

        return [
            'results'          => $results,
            'algorithm'        => $algoName,
            'time_complexity'  => $complexity,
            'comparisons'      => $comparisons,
            'time_ms'          => $timeMs,
            'records_searched' => count($students),
            'query'            => $cleanQuery,
            'strategy_note'    => $strategyNote,
        ];
    }
}
