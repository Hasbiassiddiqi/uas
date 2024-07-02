<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('transactions.create', compact('users', 'products'));
    }

    public function simpan(Request $request)
    {
        $totalAmount = 0;
        $memberPoints = 0;

        $products = json_decode($request->products, true);

        if (is_array($products) || is_object($products)) {
            foreach ($products as $productData) {
                $product = Product::find($productData['id']);
                $totalAmount += $product->price * $productData['quantity'];

                // Calculate member points
                if (in_array($product->type, ['deluxe', 'superior', 'suite'])) {
                    $memberPoints += 5 * $productData['quantity'];
                } else {
                    $memberPoints += floor(($product->price * $productData['quantity']) / 300000);
                }

                // Update available_room
                $product->available_room -= $productData['quantity'];
                $product->save();
            }
        } else {
            // Handle the case where $request->products is not an array or object
            dd('invalid products data');
        }

        // Calculate tax (11% of total amount)
        $tax = $totalAmount * 0.11;
        $totalAmountWithTax = $totalAmount + $tax;

        // Create the transaction
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_date' => now(),
            'total_amount' => $totalAmountWithTax,
            'tax' => $tax,
        ]);

        // Create transaction details
        foreach ($products as $productData) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
                'price' => Product::find($productData['id'])->price,
            ]);
        }

        // Update user member points in membership table
        $user = Auth::user();
        // dd($user->membership);
        $membership = $user->membership;
        $membership->points += $memberPoints;
        $membership->total_purchases += $totalAmount;
        $membership->save();

        return redirect()->route('transactions')
            ->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
    public function confirm(Request $request)
    {
        $products = json_decode($request->products, true);
        // dd($products);
        $totalPrice = array_reduce($products, function ($carry, $product) {
            return $carry + ($product['price'] * $product['quantity']);
        }, 0);

        return view('transactions.confirm  ', compact('products', 'totalPrice'));
    }
}
