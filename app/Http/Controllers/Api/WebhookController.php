<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderNinja;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class WebhookController extends Controller
{

    public function cancelled(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $timestamp = $decodedData['timestamp'];
            $formatDate = Carbon::parse($timestamp);
            $cancel_date = $formatDate->toDateString();


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'cancel_date' => $cancel_date,
            ]);

            return response()->json(['message' => 'Cancelled Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function pending_pickup(Request $request)
    {

        $data = $request->getContent();

        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);

            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
            ]);

            return response()->json(['message' => 'Pending Pickup Webhook, 200 OK']);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function success_pickup(Request $request)
    {

        $data = $request->getContent();

        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);

            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
            ]);

            return response()->json(['message' => 'Success Pickup Webhook, 200 OK']);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function fail_pickup(Request $request)
    {

        $data = $request->getContent();

        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);

            $tid = $decodedData['tracking_id'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Success Pickup Webhook, 200 OK']);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function receive_pending_reschedule(Request $request)
    {

        $data = $request->getContent();

        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);

            $tid = $decodedData['tracking_id'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Receive Pending Reschedule Webhook, OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function rts(Request $request)
    {

        $data = $request->getContent();

        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);

            $tid = $decodedData['tracking_id'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'RTS Webhook, OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function returned_to_senders(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $timestamp = $decodedData['timestamp'];
            $formatDate = Carbon::parse($timestamp);
            $return_date = $formatDate->toDateString();


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'return_date' => $return_date,
            ]);

            return response()->json(['message' => 'Cancelled Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function returned_to_senders_trigger(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $timestamp = $decodedData['timestamp'];
            $formatDate = Carbon::parse($timestamp);
            $return_date = $formatDate->toDateString();
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'return_date' => $return_date,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Cancelled Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function en_route_sorting_hub(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
            ]);

            return response()->json(['message' => 'En Route Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function arrive_sorting_hub(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function on_vehiche_delivery(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function pending_reschedule(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function delivery_fail(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function delivery_rts(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Sorting-Hub Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function arrive_distribution_point(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
            ]);

            return response()->json(['message' => 'Arrive Distribution Point Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function berat_paket(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $new_weight = $decodedData['new_weight'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'weight' => $new_weight,
            ]);

            return response()->json(['message' => 'Arrive Distribution Point Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function pembatalan(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Distribution Point Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function selesai(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            $comments = $decodedData['comments'];


            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
                'comments' => $comments,
            ]);

            return response()->json(['message' => 'Arrive Distribution Point Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    public function pengiriman_berhasil(Request $request)
    {
        $data = $request->getContent();
        $hmac_header = $request->header('X-Ninjavan-Hmac-SHA256');

        $verified = $this->verifyWebhook($data, $hmac_header);

        if ($verified) {
            $decodedData = json_decode($data, true);


            // Extract the tracking number
            $tid = $decodedData['tracking_id'];
            $status = $decodedData['status'];
            

            OrderNinja::where('tracking_number', $tid)->update([
                'status' => $status,
            ]);

            return response()->json(['message' => 'Arrive Distribution Point Webhook OK'], 200);
        } else {
            return response()->json(['error' => 'Webhook verification failed'], 403);
        }
    }

    private function verifyWebhook($data, $hmac_header)
    {
        $clientSecret = env('NINJA_CLIENT_SECRET');
        // define('CLIENT_SECRET', '088e0ac6b09b4c9a8463bd07af93b7e5');

        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $clientSecret, true));
        return ($hmac_header == $calculated_hmac);
    }
}
