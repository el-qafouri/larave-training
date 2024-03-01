<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $users = [
            ['name' => 'eli',
                'age' => 32,
            ],
            ['name' => 'dan',
                'age' => 3,
            ],
            ['name' => 'john',
                'age' => 38,
            ],
            ['name' => 'neli',
                'age' => 33,
            ],

        ];

        return view('dashboard',
            [
                'users' => $users,
            ]
        );
    }
}
