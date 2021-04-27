<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\OfficeType;
use App\Models\User;
use App\Models\Ticket;

use PDF;
use Storage;


class PrintController extends Controller
{
    /**
     * Handle the sales by user print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByUser($seller_ids, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('created_at', $start_date)->whereIn('seller_id', json_decode($seller_ids))->get();
        } else {
            $tickets = Ticket::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->whereIn('seller_id', json_decode($seller_ids))->get();
        }

        $users = [];
        $ticket_lists = [];

        foreach ($tickets as $key => $ticket) {
            if(!in_array($ticket->seller->fullname, $users)) {
                array_push($users, $ticket->seller->fullname);
            }

            if(!collect($ticket_lists)->contains('seller_id', $ticket->seller_id)) {
                array_push($ticket_lists, [
                    'seller_id' => $ticket->seller_id,
                    'ticket' => $ticket
                ]);
            }   
        }

        $tickets = $ticket_lists;

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-user', compact('tickets', 'users', 'start_date', 'end_date', 'date_type'));
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;

        return $pdf->download('report.pdf');
    }
}
