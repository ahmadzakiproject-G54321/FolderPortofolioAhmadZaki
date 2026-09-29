<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->latest();

        $filter = $request->query('filter', 'all');
        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }

        $search = $request->query('q');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(10)->withQueryString();

        $totalCount = Contact::count();
        $unreadCount = Contact::where('is_read', false)->count();
        $readCount = Contact::where('is_read', true)->count();

        return view('admin.contacts.index', compact(
            'contacts',
            'totalCount',
            'unreadCount',
            'readCount',
            'filter',
            'search'
        ));
    }

    public function show(int $id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function toggleRead(int $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => !$contact->is_read]);

        $statusText = $contact->is_read ? 'sudah dibaca' : 'belum dibaca';
        return back()->with('success', "Pesan dari {$contact->name} ditandai sebagai {$statusText}.");
    }

    public function markAllRead()
    {
        $updated = Contact::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', "{$updated} pesan berhasil ditandai sebagai sudah dibaca.");
    }

    public function destroy(int $id)
    {
        $contact = Contact::findOrFail($id);
        $name = $contact->name;
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', "Pesan dari {$name} berhasil dihapus.");
    }

    public function checkUnread()
    {
        $unreadCount = Contact::where('is_read', false)->count();
        $latest = Contact::where('is_read', false)
            ->latest()
            ->take(5)
            ->get(['id', 'name', 'phone', 'subject', 'created_at'])
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'phone' => $c->phone ?: '-',
                    'subject' => \Illuminate\Support\Str::limit($c->subject, 35),
                    'time_ago' => $c->created_at->diffForHumans(),
                    'url' => route('admin.contacts.show', $c->id),
                ];
            });

        return response()->json([
            'unread_count' => $unreadCount,
            'latest' => $latest,
        ]);
    }
}
