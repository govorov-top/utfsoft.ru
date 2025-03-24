<div class="popup" id="pick_up_point">
	<div class="pop html text-center" style="max-width: 900px">
		<p class="title">Выберите пункт выдачи</p>
		<div id="points">
			<div class="d-flex flex-wrap justify-content-around mb-4">
				<div class="flex-box text-center" style="width: 100%; max-width: 330px">
					<label for="map-points" class="d-block">Выберите Ваш регион:</label>
					<select name="regions" id="map-points" class="=js-states regions form-control select">

					</select>
				</div>
				<div class="flex-box text-center" style="width: 100%; max-width: 330px">
					<label for="map-points2">Выберите ближайший пункт выдачи:</label>
					<select name="address" id="map-points2" class="js-states city form-control select all_points">

					</select>
				</div>
			</div>
			<div id="yandexMap" class="d-flex flex-column justify-content-around" style="width: 100%; height: 600px">
                <div class="align-self-center loader"></div>
            </div>
		</div>
	</div>
</div>