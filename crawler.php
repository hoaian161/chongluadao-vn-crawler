<?php
error_reporting(0);

$i = 0;
$j = 0;
$iFrom = 0;

while(true){
    $i++;
    $iFrom = ($i - 1) * 100;

    $crawlData = crawl($iFrom);
    if(empty($crawlData))
        exit();

    foreach($crawlData as $data){
        echo (++$j)."/ ".$data[1]."\n";
    }
}

function crawl($offset){
    $url = buildUrl($offset);
    echo "---- Offset: ".$offset." ----\n";
    
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data["data"] ?? [];
}

function buildUrl($offset){
    $baseUrl = "https://chongluadao.vn/datatables-server-side-processing";
    $queryParams = [
        "type" => "blacklist",
        "draw" => ($offset / 100 + 1),
        "columns[0][data]" => 0,
        "columns[0][name]" => "",
        "columns[0][searchable]" => "true",
        "columns[0][orderable]" => "true",
        "columns[0][search][value]" => "",
        "columns[0][search][regex]" => "false",
        "columns[1][data]" => 1,
        "columns[1][name]" => "",
        "columns[1][searchable]" => "true",
        "columns[1][orderable]" => "true",
        "columns[1][search][value]" => "",
        "columns[1][search][regex]" => "false",
        "columns[2][data]" => 2,
        "columns[2][name]" => "",
        "columns[2][searchable]" => "true",
        "columns[2][orderable]" => "false",
        "columns[2][search][value]" => "",
        "columns[2][search][regex]" => "false",
        "columns[3][data]" => 3,
        "columns[3][name]" => "",
        "columns[3][searchable]" => "true",
        "columns[3][orderable]" => "true",
        "columns[3][search][value]" => "",
        "columns[3][search][regex]" => "false",
        "columns[4][data]" => 4,
        "columns[4][name]" => "",
        "columns[4][searchable]" => "true",
        "columns[4][orderable]" => "true",
        "columns[4][search][value]" => "",
        "columns[4][search][regex]" => "false",
        "order[0][column]" => 0,
        "order[0][dir]" => "desc",
        "start" => $offset,
        "length" => 100,
        "search[value]" => "",
        "search[regex]" => "false",
        "_" => time()
    ];

    return $baseUrl.'?'.http_build_query($queryParams);
}
