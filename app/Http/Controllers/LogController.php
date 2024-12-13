<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class LogController extends Controller
{
    /**
     * Display the user activity logs with pagination and summary counts.
     */
    public function index(Request $request)
    {
        $logFilePath = storage_path('logs/laravel.log'); // Path to the log file

        // Check if the log file exists
        if (!File::exists($logFilePath)) {
            return view('admin/log', [
                'logs' => [],
                'summary' => [
                    'logins' => 0,
                    'logouts' => 0,
                    'form_submissions' => 0,
                    'form_updates' => 0,
                ],
            ]);
        }

        // Read the log file content
        $logContents = File::get($logFilePath);

        // Split log entries by new lines to create an array of log entries
        $logEntries = explode("\n", trim($logContents));

        // Reverse log entries to display newest logs first
        $logEntries = array_reverse($logEntries); 

        // Filter logs for user-related activities
        $filteredLogs = array_filter($logEntries, function($log) {
            return str_contains($log, 'User Logged In') 
                || str_contains($log, 'User Logged Out') 
                || str_contains($log, 'Form Submitted') 
                || str_contains($log, 'Form Updated');
        });

        // Extract key log information
        $formattedLogs = array_map(function($log) {
            preg_match('/\[(.*?)\] local.INFO: (.*?) (\{.*?\})/', $log, $matches);
            return [
                'date' => $matches[1] ?? 'N/A',
                'message' => $matches[2] ?? 'N/A',
                'details' => json_decode($matches[3] ?? '{}', true),
            ];
        }, $filteredLogs);

        // Count occurrences of each activity
        $summary = [
            'logins' => count(array_filter($formattedLogs, fn($log) => str_contains($log['message'], 'User Logged In'))),
            'logouts' => count(array_filter($formattedLogs, fn($log) => str_contains($log['message'], 'User Logged Out'))),
            'form_submissions' => count(array_filter($formattedLogs, fn($log) => str_contains($log['message'], 'Form Submitted'))),
            'form_updates' => count(array_filter($formattedLogs, fn($log) => str_contains($log['message'], 'Form Updated'))),
        ];

        // Pagination logic
        $perPage = 20; 
        $currentPage = $request->get('page', 1); 
        $offset = ($currentPage - 1) * $perPage;
        $currentPageLogs = array_slice($formattedLogs, $offset, $perPage); 

        $logs = new LengthAwarePaginator($currentPageLogs, count($formattedLogs), $perPage, $currentPage, [
            'path' => $request->url(), 
            'query' => $request->query()
        ]);

        return view('admin/log', [
            'logs' => $logs,
            'summary' => $summary
        ]);
    }
}
