<?php

use App\Models\User;

echo "Total Users: " . User::count() . "\n";
echo "Agents: " . User::where('role', 'agent')->count() . "\n";
foreach (User::where('role', 'agent')->get() as $agent) {
    echo "Agent: " . $agent->name . " (" . $agent->email . ")\n";
}
