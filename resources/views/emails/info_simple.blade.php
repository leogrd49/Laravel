<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #4CAF50; margin-top: 0;">{{ $subject }}</h1>
                <p>{{ $content }}</p>

                @if(!empty($details))
                    <h2 style="color: #333;">{{ __('absencedetail') }}</h2>
                    <table cellpadding="8" cellspacing="0" border="0" width="100%" style="border-collapse: collapse;">
                        @foreach($details as $key => $value)
                            <tr>
                                <th style="background-color: #4CAF50; color: white; text-align: left; border: 1px solid #ddd;">{{ $key }}</th>
                                <td style="border: 1px solid #ddd;">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </td>
        </tr>
    </table>
</body>
</html>
