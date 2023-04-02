<?php
    $ip = $_SERVER['REMOTE_ADDR']; // pre-check user's IP
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple IP Address Checker</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center mt-10">
        <div class="w-full max-w-lg">
            <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="ip-address">
                        <a href="/" target="_self">IP Address Checker</a>
                    </label>
                    <?php
                        $ip_address = $_SERVER['REMOTE_ADDR'];
                    ?>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ip-address" name="ip-address" type="text" placeholder="Enter IP address" value="<?php echo $ip_address ?>">
                    <?php echo '<p class="italic text-gray-600 text-sm mt-2">Your IP address is <font class="font-italic text-red-700">'.$ip_address.'</font></p>'; ?>
                    
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Check
                    </button>
                </div>
            </form>
            <p class="text-xs italic">* Support for ipv4 and ipv6.</p>
            <?php
                if(isset($_POST['ip-address'])) {
                    $ip_address = $_POST['ip-address'];
                    $url = "http://ip-api.com/json/{$ip_address}?fields=status,message,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,isp,org,as,asname,mobile,proxy,query";
                    $json = file_get_contents($url);
                    $details = json_decode($json);
                    $lat = $details->lat;
                    $lon = $details->lon;
                    $loc = $lat.', '.$lon;

                    echo '<br><div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">';
                    echo '<strong class="font-bold">IP Details:</strong><br>';
                    echo '<ul>';
                    echo '<li>IP: '.$details->query.'</li>';
                    echo '<li>City: '.$details->city.'</li>';
                    echo '<li>Region: '.$details->regionName.'</li>';
                    echo '<li>District: '.$details->district.'</li>';
                    echo '<li>Country: '.$details->country.'</li>';
                    echo '<li>Postal: '.$details->zip.'</li>';
                    echo '<li>Location: <font class="font-bold text-sm text-blue-700"><a href="https://www.google.com/maps/search/'.$loc.'" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> '.$loc.'</a></font></li>';
                    echo '<li>ISP: '.$details->isp.'</li>';
                    echo '<li>Timezone: '.$details->timezone.'</li>';
                    echo '<li>ASN: '.$details->as.'</li>';
                    echo '<li>AsName: '.$details->asname.'</li>';
                    echo '<li>Mobile: '.$details->mobile.'</li>';
                    echo '<li>Proxy: '.$details->proxy.'</li>';
                    echo '</ul>';
                    echo '<br><p class="italic">IP database by <a class="underline hover:no-underline" href="https://ip-api.com" target="_blank" rel="noopener">ip-api.com</a></p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
