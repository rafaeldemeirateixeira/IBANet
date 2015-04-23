<article class="box page-content view_back">
    <header>
        <h2>{$title}</h2>
        <p>{$subTitle}</p>
        <ul class="meta">
            <li class="icon fa-clock-o">{$dateTime}</li>
        </ul>
    </header>
    {foreach from=$section key=id item=line}
        <h3 class="icon fa-asterisk"> {$line.title}</h3>
        <table>
            {foreach from=$line.item key=idL item=text}

                {if $text.mapa eq true}
                    <tr>
                        <td colspan="2">
                            <div id="map-canvas" style="height: 300px;" class="box page-content view_back"></div>
                            <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                            <script>
                                function initialize() {
                                    var mapOptions = {
                                        scaleControl: true,
                                        center: new google.maps.LatLng({$text.latlon}),
                                        zoom: 16
                                    };

                                    var map = new google.maps.Map(document.getElementById('map-canvas'),
                                            mapOptions);

                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: map.getCenter()
                                    });
                                    var infowindow = new google.maps.InfoWindow();
                                    google.maps.event.addListener(marker, 'click', function() {
                                        infowindow.open(map, marker);
                                    });
                                }
                                google.maps.event.addDomListener(window, 'load', initialize);
                            </script>
                        </td>
                    </tr>
                {else}
                    <tr>
                        <td width="10%" align="left"><h5>{$text.label}: </h5></td>
                        <td width="90%" align="left"><i>{$text.value}</i></td>
                    </tr>
                {/if}
            {/foreach}
        </table>
    {/foreach}
</article>