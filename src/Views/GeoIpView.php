<?php


namespace GeoIp\Views;


class GeoIpView
{
    public function showPageLoadData(): void
    {
        ?>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="css/geoIp.css">
        <div class="preloader_main hidden" id="preloader">
            <div class="preloader">
                <div class="dot dot_1"></div>
                <div class="dot dot_2"></div>
                <div class="dot dot_3"></div>
            </div>
        </div>

        <div class="geoip_control">
            <h2 class="geoip_title">Управление данными модуля GeoIp</h2>
            <div class="geoip_main_tabs">
                <div class="geoip_tabs_title">
                    <div class="geoip_tab_block" data-tab-name="logic">Главное</div>
                    <div class="geoip_tab_block" data-tab-name="source_data">Источник данных</div>
                    <div class="geoip_tab_block" data-tab-name="city">Города</div>
                    <div class="geoip_tab_block" data-tab-name="ip">Ip-адреса</div>
                </div>
                <div class="geoip_tabs_data">

                    <div class="geoip_tab_data" data-tab-name="hello">
                        <div class="geoip_tab_data--block">
                            <h2>Приветствие</h2>

                        </div>
                    </div>

                    <div class="geoip_tab_data hidden" data-tab-name="logic">
                        <div class="geoip_tab_data--block">
                            <h2>Главное</h2>

                            <h4>Получение информации о городе по заданному ip</h4>
                            <form id="geoip_get-info-by-ip" class="geoip_form">
                                <input type="hidden" name="act" value="get-info-by-ip">
                                <input type="text" name="ip" value="188.168.153.124">
                                <button id="geoip_btn-git-info-by-ip">
                                    Получить информацию
                                </button>
                            </form>

                            <h4>Получение информации о местоположении по текущему IP пользователя</h4>

                            <form id="geoip_get-info-by-current-ip" class="geoip_form">
                                <input type="hidden" name="act" value="get-info-by-current-ip">
                                <button id="geoip_btn-git-info-by-current-ip">где я?</button>
                            </form>


                        </div>
                    </div>


                    <div class="geoip_tab_data hidden" data-tab-name="source_data">
                        <div class="geoip_tab_data--block">
                            <h2>Управление</h2>

                            <h4>Инициализация</h4>
                            <form id="initialForm" class="geoip_form">
                                <label>Загрузить данные из архива во временную папку</label>
                                <input type="text" name="url" value="hello">
                                <button id="submitForm">вперед</button>
                            </form>

                            <h4>Очистка</h4>
                            <button>Удалить временную папку с данными</button>

                        </div>
                    </div>


                    <div class="geoip_tab_data hidden" data-tab-name="city">
                        <div class="geoip_tab_data--block">
                            <h2>Города</h2>
                            <div class="geoip_tab_data--first_block">
                                <button class="geoip_btn" id="geoip_delete_city_table">При наличии таблицы для хранения городов удалить ее</button>
                                <button class="geoip_btn" id="geoip_new_city_table">Создать (или очистить) таблицу со списком городов</button>
                            </div>

                            <button id="updateListCity">Обновить список городов</button>

                            <div class="infoCity hidden" id="geoip_block_info_city">
                                <h2>City</h2>
                                <h3 id="geoip_info_city-title">Всего найдено </h3>
                                <form id="infoCity">
                                    <label>обрабатывать по </label>
                                    <input name="stepCount" type="number">
                                    <input name="numPage" type="number" value="1" class="hidden">
                                    <input name="type" type="text" value="city" class="hidden">
                                    <button id="submitFormInfoCity">работать</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="geoip_tab_data hidden" data-tab-name="ip">
                        <div class="geoip_tab_data--block">
                            <h2>Ip-адреса</h2>
                            <div class="geoip_tab_data--first_block">
                                <button class="geoip_btn" id="geoip_delete_ip_table">При наличии таблицы для хранения ip-адресов удалить ее</button>
                                <button class="geoip_btn" id="geoip_new_ip_table">Создать (или очистить) таблицу со списком ip-адресов</button>
                            </div>

                            <button id="updateListIp">Обновить список ip-адресов</button>

                            <div class="infoIp hidden" id="geoip_block_info_ip">
                                <h2>IP</h2>
                                <h3 id="geoip_info_ip-title">Всего найдено </h3>
                                <form id="infoIp">
                                    <label>обрабатывать по </label>
                                    <input name="stepCount" type="number">
                                    <input name="numPage" type="number" value="1" class="hidden">
                                    <input name="type" type="text" value="ip" class="hidden">
                                    <button id="submitFormInfoIp">работать</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <div class="geoip_background_popup hidden" id="geoip_background_popup">
            <div class="geoip_popup">
                <div id="geoip_popup_close">
                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" width="50px" id="geoip_js_popup_close">
                        <defs>
                            <style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                        </defs>
                        <title/>
                        <g id="cross">
                            <line class="cls-1" x1="7" x2="25" y1="7" y2="25"/>
                            <line class="cls-1" x1="7" x2="25" y1="25" y2="7"/>
                        </g>
                    </svg>
                    <h3 class="geoip_popup_title">Найденная информация</h3>
                </div>

                <div id="geoip_body_info">

                    <table>
                        <tr>
                            <th>Название</th>
                            <th>Значение</th>
                        </tr>
                        <tr>
                            <td class="geoip_table_info--left">hello</td>
                            <td class="geoip_table_info--right">q</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>3</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

        <style>
            body, input, button {
                font-family: 'Poiret One', cursive;
            }
            input, button {
                font-size: 18px;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/GeoIp.js"></script>
        <script type="text/javascript" src="js/scriptGeoIp.js"></script>

        <?php
    }
}
