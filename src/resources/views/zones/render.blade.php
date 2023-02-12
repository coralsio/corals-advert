@isset($zone)
    {!! \Advert::getRandomWeightedBanner($zone) !!}

    <script>
        window.onload = function () {
            if (typeof embed !== 'undefined') {
                var embedChild = new embed.Child();
                embedChild.sendHeight();
            }
        }

    </script>
@else
    <p class="text-center text-danger">
        <strong>
            Zone [{{ @$zone_key }}] Cannot be found
        </strong>
    </p>
@endisset