<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
    body {margin: 0; padding: 0; min-width: 100%!important;}
    .content {width: 100%; max-width: 600px;}  
    </style>
	<title>Konfirmasi Akun - {{ config('app.name') }}</title>
</head>
<body yahoo bgcolor="#f6f8f1">
	<h1>{{ config('app.name') }}</h1>
    <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                            Klik <a href="{{ $link }}">link ini</a> untuk memverifikasi akun anda
                        </td>
                    </tr>
                    <tr>
                    	<td>
                    		Terima kasih.
                    	</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>