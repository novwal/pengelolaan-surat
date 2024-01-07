<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-container {
            display: flex;
            justify-content: space-between;
        }

        .department,
        .information {
            width: 48%;
            padding: 20px;
        }

        .department p,
        .information p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .date,
        .information2,
        .department2,
        .content,
        .user,
        .respect,
        .signature,
        .attachment {
            margin-top: 20px;
            padding: 20px;
        }

        .box {
            display: flex;
            justify-content: space-between;
        }

        .department-2 {
            justify-content: flex-end;
        }

        .btn-back,
        .btn-print {
            padding: 8px 15px;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-back {
            background: #666;
        }

        .btn-print {
            background: #007bff;
        }
    </style>
</head>

<body>

    <div class="form">
        <h1>SMK WIKRAMA BOGOR</h1>

        <div class="box">
            <div class="departmen">
                <p>Teknologi Informasi dan Komunikasi</p>
                <p>Bisnis dan Manajemen</p>
                <p>Pariwisata</p>
            </div>

            <div class="information">
                <p>Jl. Raya Wangun Kel. Sindangsari Bogor</p>
                <p>Telp: (031)99787059</p>
                <p>E-mail: prohumasi@smkwikrama.sch.id</p>
                <p>Website: www.smkmikrama.sch.id</p>
            </div>
        </div>
        <hr>

        <div class="date">
            {{ $surat->created_at->format('d-m-Y') }}
        </div>

        <div class="box">
            <div class="information2">
                <p>No : 260062/0002/SMK Wikrama Bogor/2023</p>
                <p>Hal : {{ $surat->letter_perihal }}</p>
            </div>

            <div class="department2">
                <p>Kepada</p>
                <p>Yth. Bapak/Ibu Terlampir</p>
                <p>Tempat</p>
            </div>
        </div>

        <div class="content">
            {{ $surat->content }}
        </div>

        <div class="user">
            <p>Bapak/ibu yang Menghadiri</p>
            <ol>
                <li>
                    {{ implode(', ', array_column($surat->recipients, 'name')) }}
                </li>
            </ol>
        </div>

        <div class="respect">
            <p>Hormat Kami</p>
            <p>Kepala SMK Wikrama Bogor</p>
        </div>

        <div class="signature">
            (......................)
        </div>
    </div>

    <div class="attachment" style="margin-top: 100px">
        <center>
            {{ $surat->attachment }}
        </center>
    </div>
</body>

</html>
