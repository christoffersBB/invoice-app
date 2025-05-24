<!-- resources/views/invoice_pdf/invoice-sent.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: #f8fafc;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 32px 40px 40px 40px;
        }
        .header {
            border-bottom: 2px solid #fc5800;
            padding-bottom: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header h1 {
            color: #fc5800;
            font-size: 2rem;
            margin: 0;
        }
        .invoice-details {
            margin-bottom: 32px;
        }
        .invoice-details p {
            margin: 6px 0;
            font-size: 1.05rem;
        }
        .section-title {
            color: #fc5800;
            font-weight: bold;
            margin-top: 32px;
            margin-bottom: 12px;
            font-size: 1.1rem;
        }
        .amount {
            font-size: 1.5rem;
            color: #16a34a;
            font-weight: bold;
            margin-top: 16px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #888;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Invoice</h1>
            <span>#{{ $invoice->invoice_number }}</span>
        </div>
        <div class="invoice-details">
            <p><strong>Client Name:</strong> {{ $clientName }}</p>
            <p><strong>Project Name:</strong> {{ $projectName }}</p>
            <p><strong>Rate:</strong> ${{ number_format($rate, 2) }}</p>
            <p><strong>Total Hours:</strong> {{ $totalHours }}</p>
            <p><strong>Amount:</strong> <span class="amount">${{ number_format($amount, 2) }}</span></p>
        </div>
        <div>
            <div class="section-title">Invoice Summary</div>
            <p><strong>Status:</strong> {{ $invoice->status }}</p>
            <p><strong>Issued On:</strong> {{ $invoice->created_at->format('F d, Y') }}</p>
        </div>
        <div class="footer">
            Thank you for your business!<br>
            <span style="color:#fc5800;">The Invoicer Team</span>
        </div>
    </div>
</body>
</html>
