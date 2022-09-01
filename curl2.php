<?php 

 function http_request($url)
{
        $ch = curl_init();

        //setURL
        curl_setopt($ch, CURLOPT_URL, $url);

        //aktifkan fungsu transfer nilai yang berupa string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //settin agar dapat dijalankaj pada localhist
        //mematikan ssl verify (https)

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // tam[pung hasil ke dalam variable $output
        $output = curl_exec($ch);

        // mengembalikan hasil curl
        return $output;
}

//panggil fungsi http_request (url / link api)
$data = http_request("https://data.covid19.go.id/public/api/prov.json");

$data = json_decode($data, TRUE);

    // echo "<pre>";
    //     print_r($data);
    // echo "<pre>";

    //tampung jumlah data
$jumlah = count($data);

$nomor = 1;

for ($i=0; $i < $jumlah; $i++) { 
    $hasil = $data[$i]['list_data'];

?>
    <tr>
        <td><?=$nomor++ ?></td>
        <td><?=$hasil['key'] ?></td>
        <td><?=$hasil['jumlah_kasus'] ?></td>
        <td><?=$hasil['jumlah_sembuh'] ?></td>
        <td><?=$hasil['jumlah_meninggal'] ?></td>
    </tr>
<?php
    }
?>