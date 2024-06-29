<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $name }}</title>

    {{-- css reset --}}
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>

    {{-- css custom --}}
    <style>
        @page {
            size: 21cm 29.7cm;
        }

        body {
            margin: 2cm 2.54cm;
            font-size: 11pt;
            line-height: 1.5;
        }

        #diagnosa-table {
            width: 100%;
        }

        #diagnosa-table th,
        #diagnosa-table td {
            border: 1px solid black;
            text-align: left;
            padding: 2px 8px;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; font-weight: bold; text-transform: uppercase;">HASIL NILAI DEPRESI SISWA</h1>
    <div style="margin: 16px 0px;">
        <table>
            <tr>
                <td>Nama</td>
                <td style="padding: 0px 8px;">:</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td style="padding: 0px 8px;">:</td>
                <td style="text-transform: capitalize;">{{ $kelas }}</td>
            </tr>
            <tr>
                <td>Tanggal Pengujian</td>
                <td style="padding: 0px 8px;">:</td>
                <td>{{ $created_at }}</td>
            </tr>
        </table>
    </div>
    <div style="margin: 16px 0px;">
        <table id="diagnosa-table">
            <thead>
                <tr>
                    <th style="width: 20px; text-align: center;">No</th>
                    <th>Pertanyaan</th>
                    <th style="text-align: center;">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evidence as $item)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>Apakah anda pernah merasa <span
                                style="text-transform: lowercase;">{{ $item['gejala'] }}</span>?</td>
                        <td style="text-align: center; white-space: nowrap">{{ $item['kondisi'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin: 16px 0px;">
        <table>
            <tr>
                <td style="white-space: nowrap">Hasil Diagnosa</td>
                <td style="padding: 0px 8px;">:</td>
                @if ($tingkat_depresi == 'Tidak Depresi')
                    <td>Tidak depresi</td>
                @else
                    <td>Tingkat <span
                            style="text-transform: lowercase; font-weight: bold;">{{ $tingkat_depresi }}</span>
                        sebesar<span style="font-weight: bold;">
                            {{ $persentase }}%</span></td>
                @endif
            </tr>
            <tr>
                <td>Catatan</td>
                <td style="padding: 0px 8px;">:</td>
                <td>Silahkan datang ke Guru BK Kelas {{ $kelas }} sebelum tanggal {{ $deadline }} saat jam
                    istirahat.</td>
            </tr>
        </table>
    </div>
</body>

</html>
