<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoveCalculatorController extends Controller
{
    public function index()
    {
        return view('love-calculator');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'name1' => 'required|string|max:50',
            'name2' => 'required|string|max:50',
        ]);

        $name1 = strtolower(trim($request->name1));
        $name2 = strtolower(trim($request->name2));
        
        // Modern love calculation algorithm
        $combinedNames = $name1 . $name2;
        $loveScore = 0;
        
        // Calculate based on letters and their positions
        for ($i = 0; $i < strlen($combinedNames); $i++) {
            $char = $combinedNames[$i];
            $charCode = ord($char);
            $loveScore += ($charCode * ($i + 1)) % 100;
        }
        
        // Add some randomness for variety
        $loveScore = ($loveScore + rand(0, 20)) % 101;
        
        // Ensure minimum 20% for romance
        $loveScore = max(20, $loveScore);
        
        // Generate romantic message based on score
        $message = $this->getLoveMessage($loveScore);
        
        return response()->json([
            'success' => true,
            'percentage' => $loveScore,
            'message' => $message
        ]);
    }

    private function getLoveMessage($percentage)
    {
        if ($percentage >= 90) {
            return "💕 Soulmates! Your love is written in the stars! 💕";
        } elseif ($percentage >= 80) {
            return "💖 Deep connection! You're meant to be together! 💖";
        } elseif ($percentage >= 70) {
            return "💝 Strong attraction! Love is in the air! 💝";
        } elseif ($percentage >= 60) {
            return "💗 Good chemistry! Keep exploring this connection! 💗";
        } elseif ($percentage >= 50) {
            return "💓 Potential for love! Take your time! 💓";
        } elseif ($percentage >= 40) {
            return "💞 Friendship could blossom into something more! 💞";
        } else {
            return "💘 Every love story is unique - keep an open heart! 💘";
        }
    }
}
