import * as GeoIp from './GeoIp';

let preloader = document.getElementById("preloader");

let page = 1;

const btnForm1 = document.getElementById("submitForm");
let geoIp = new GeoIp();

btnForm1.onclick = (event) => {
    event.preventDefault();
    let form = $("#initialForm").serialize();
    console.log(form);
    geoIp.initialRequest(form);
}


const btnFormCity = document.getElementById("submitFormInfoCity");
btnFormCity.onclick = (event) => {
    event.preventDefault();
    geoIp.batchLoad("city");
}

const btnFormIp = document.getElementById("submitFormInfoIp");
btnFormIp.onclick = (event) => {
    event.preventDefault();
    geoIp.batchLoad("ip");
}

let tab_titles = document.getElementsByClassName("geoip_tab_block");
let tab_data = document.getElementsByClassName("geoip_tab_data");
for (let i = 0; i < tab_titles.length; i++) {
    tab_titles[i].onclick = () => {
        for (let j = 0; j < tab_data.length; j++) {
            if (tab_titles[j]) {
                tab_titles[j].classList.remove("active-tab");
            }
            if (tab_titles[i].getAttribute("data-tab-name") === tab_data[j].getAttribute("data-tab-name")) {
                tab_data[j].classList.remove("hidden");
            } else {
                tab_data[j].classList.add("hidden");
            }
        }
        tab_titles[i].classList.add("active-tab");
    }
}

let btnUpdateListCity = document.getElementById("updateListCity");

btnUpdateListCity.onclick = () => {
    geoIp.getInfo("city");
}

let btnUpdateListIp = document.getElementById("updateListIp");
btnUpdateListIp.onclick = () => {
    geoIp.getInfo("ip");
}


let btnNewTableCity = document.getElementById("geoip_new_city_table");
btnNewTableCity.onclick = () => {
    geoIp.newTableDP("city");
}

let btnDeleteTableCity = document.getElementById("geoip_delete_city_table");
btnDeleteTableCity.onclick = () => {
    geoIp.deleteTableDP("city");
}

let btnNewTableIp = document.getElementById("geoip_new_ip_table");
btnNewTableIp.onclick = () => {
    geoIp.newTableDP("ip");
}

let btnDeleteTableIp = document.getElementById("geoip_delete_ip_table");
btnDeleteTableIp.onclick = () => {
    geoIp.deleteTableDP("ip");
}

let btnGetInfoByIp = document.getElementById("geoip_btn-git-info-by-ip");
btnGetInfoByIp.onclick = () => {
    event.preventDefault();
    let form = $("#geoip_get-info-by-ip").serialize();
    geoIp.getInfoByIp(form);
}

let btnGetInfoByCurrentIp = document.getElementById("geoip_btn-git-info-by-current-ip");
btnGetInfoByCurrentIp.onclick = (event) => {
    event.preventDefault();
    let form = $("#geoip_get-info-by-current-ip").serialize();
    geoIp.getInfoByIp(form);
}

let btnClosePopup = document.getElementById("geoip_js_popup_close");
btnClosePopup.onclick = () => {
    let popup = document.getElementById("geoip_background_popup");
    popup.classList.add("hidden");

}
