<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\CartItem;

use Carbon\Carbon;
class CheckCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:cartItems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired cart items';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $carbon = Carbon::now();
        $cart_items = CartItem::all();
        foreach ($cart_items as $item) {
           if($carbon->diffInDays($item->expiration) == 0){
                dd($item->product->name);
               $item->product->quantity = $item->product->quantity + $item->quantity;
               $item->product->save();
               CartItem::destroy($item->id);
           }
        }
    }
}
