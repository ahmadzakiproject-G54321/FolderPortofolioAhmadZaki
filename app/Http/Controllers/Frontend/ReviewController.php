<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'project_name' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:2000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'rating.required' => 'Rating bintang wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'review.required' => 'Ulasan atau testimoni wajib diisi.',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        $nextOrder = ((int)Review::max('sort_order')) + 1;

        $review = Review::create([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
            'project_name' => $request->input('project_name'),
            'rating' => (int)$request->input('rating', 5),
            'review' => $request->input('review'),
            'is_approved' => false,
            'sort_order' => $nextOrder,
        ]);

        $successMessage = 'Terima kasih! Penilaian Anda telah berhasil dikirim dan akan segera ditampilkan setelah diverifikasi admin.';

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'review' => $review,
            ]);
        }

        return back()->with('success', $successMessage);
    }
}
