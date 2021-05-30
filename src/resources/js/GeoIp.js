function visibleDetailBlock(id) {
    let block = document.getElementById(id);
    block.classList.remove("hidden")
}

function setTitleForm(num, idName) {
    let numFormat = new Intl.NumberFormat('ru-RU').format(num);
    let title = document.getElementById(idName);
    title.innerHTML = "В файле " + numFormat + " строк";
}

function setNumPage(num, idForm) {
    let form = $("#" + idForm);
    let input = form.find("[name='numPage']");
    input.val(num);
}

function getFDByIdForm(idForm) {
    let str = $("#" + idForm).serialize();
    return str;
}

class GeoIp {
    constructor(urlAjax = "/geoip-ajax") {
        this.urlAjax = urlAjax;
    }

    initialRequest(data) {
        $.ajax({
            url: this.urlAjax,
            method: 'post',
            dataType: 'json',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
            },
            success: function (ans) {
                setTitleForm(ans["city"]["size"], "infoCityTitle");
                setTitleForm(ans["ip"]["size"], "infoIpTitle");
                visibleDetailBlock();
                console.log(ans);
            }
        });
    }

    ajaxBatchLoad(page, idForm, preloader) {
        let that = this;
        let data = getFDByIdForm(idForm);
        $.ajax({
            url: that.urlAjax,
            method: 'post',
            dataType: 'json',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
            },
            success: function (ans) {
                console.log(ans["info"]["nextPage"]);
                if (ans["info"]["nextPage"] !== -1) {
                    setNumPage(ans["info"]["nextPage"], idForm);
                    that.ajaxBatchLoad(ans["info"]["nextPage"], idForm, preloader)
                } else {
                    preloader.classList.add("hidden");
                    alert("готово")
                }
            }
        });
    }

    batchLoad(type) {
        let preloader = document.getElementById("preloader");
        preloader.classList.remove("hidden");
        let page = 1, cnt = 1;
        let idForm = "";
        if (type === 'city') {
            idForm = "infoCity";
        } else if (type === "ip") {
            idForm = "infoIp"
        }
        this.ajaxBatchLoad(1, idForm, preloader);
    }

    getInfo(type) {
        let preloader = document.getElementById("preloader");
        preloader.classList.remove("hidden");
        $.ajax({
            url: this.urlAjax,
            method: 'post',
            dataType: 'json',
            data: {
                "act": "get-info",
                "type": type
            },
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
                preloader.classList.add("hidden");
                console.log(preloader.classList);
            },
            success: function (ans) {
                preloader.classList.add("hidden");
                console.log(ans)
                if (type === "city") {
                    setTitleForm(ans["size"], "geoip_info_city-title");
                    visibleDetailBlock("geoip_block_info_city");
                }
                if (type === "ip") {
                    setTitleForm(ans["size"], "geoip_info_ip-title");
                    visibleDetailBlock("geoip_block_info_ip");
                }
            }
        });
    }

    newTableDP(type) {
        $.ajax({
            url: this.urlAjax,
            method: 'post',
            dataType: 'json',
            data: {
                "act": "new-table",
                "type": type
            },
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
            },
            success: function (ans) {
                alert(type + " table update(create) ok");
            }
        });
    }

    deleteTableDP(type) {
        $.ajax({
            url: this.urlAjax,
            method: 'post',
            dataType: 'json',
            data: {
                "act": "delete-table",
                "type": type
            },
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
            },
            success: function (ans) {
                alert(type + " table delete ok");
            }
        });
    }

    getInfoByIp(data) {
        $.ajax({
            url: this.urlAjax,
            method: 'post',
            dataType: 'json',
            data: data,
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: function (ans) {
                alert("ERROR")
            },
            success: function (ans) {
                let popup = document.getElementById("geoip_background_popup");
                popup.classList.remove("hidden");


                let str = "<table><tr><th>Название</th><th>Значение</th></tr>";
                if (ans.length > 0) {
                    for (const [key, value] of Object.entries(ans[0]["city"])) {
                        str += "<tr><td class='geoip_table_info--left'>" + key + "</td><td class='geoip_table_info--right'>" + value + "</td></tr>";
                    }

                    for (const [key, value] of Object.entries(ans[0]["ip"])) {
                        str += "<tr><td class='geoip_table_info--left'>" + key + "</td><td class='geoip_table_info--right'>" + value + "</td></tr>";
                    }
                }
                str += "</table>"

                let blockForTable = document.getElementById("geoip_body_info");
                blockForTable.innerHTML = str;
                console.log(ans);
            }
        });
    }
}

module.exports = GeoIp;

