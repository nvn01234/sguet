<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<table>
    <thead>
    <tr style="text-align: center">
        <th>STT</th>
        <th>Tên</th>
        <th>Chức vụ</th>
        <th>SĐT CQ</th>
        <th>SĐT NR</th>
        <th>SĐT DĐ</th>
        <th>Fax</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td style="text-align: left">{{$contact->stt}}</td>
            <td style="width: 50px;">{{$contact->name}}</td>
            <td style="width: 20px;">{{$contact->description}}</td>
            <td style="width: 20px;">{{$contact->phone_cq}}</td>
            <td style="width: 20px;">{{$contact->phone_nr}}</td>
            <td style="width: 20px;">{{$contact->phone_dd}}</td>
            <td style="width: 20px;">{{$contact->fax}}</td>
            <td style="width: 20px;">{{$contact->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>