<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <title>Bagan Struktur Organisasi</title>
    <style id="myStyles">
        html,
        body {
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100%;
            font-family: Helvetica;
            overflow: hidden;
        }

        #tree {
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>

    <script src="<?= base_url('assets/publik/js/orgchart.js') ?>"></script>

    <div id="tree"></div>
    <script>
        var chart;
        window.onload = function() {

            //header
            OrgChart.templates.header = Object.assign({}, OrgChart.templates.ana);
            OrgChart.templates.header.svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  style="display:block;background-color: #BFE0F1" width="{w}" height="{h}" viewBox="{viewBox}">{content}</svg>';
            OrgChart.templates.header.header1 = '<text text-anchor="middle" width="400" style="font-size: 18px;font-weight:bold;" fill="#3F7D95" x="200" y="20">{val}</text>';
            OrgChart.templates.header.header2 = '<text text-anchor="middle" width="400"  style="font-size: 18px;" fill="#3F7D95" x="200" y="40">{val}</text>';
            OrgChart.templates.header.size = [400, 50];
            OrgChart.templates.header.node = '';
            OrgChart.templates.header.link = '<path stroke-linejoin="round" stroke="#fff" stroke-width="1px" fill="none" d="M{xa},{ya} {xb},{yb} {xc},{yc} L{xd},{yd}" />';

            OrgChart.templates.header.plus = '';
            OrgChart.templates.header.minus = '';

            //template
            OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.base);
            OrgChart.templates.myTemplate.size = [270, 150];
            OrgChart.templates.myTemplate.node =
                '<rect x="0" y="0" height="{h}" width="{w}" fill="#f4f3f3" stroke-width="1" stroke="#fff" rx="1" ry="1"></rect><circle cx="45" cy="60" r="35" fill="#fff"></circle>';
            OrgChart.templates.myTemplate.plus = "";
            OrgChart.templates.myTemplate.minus = "";
            OrgChart.templates.myTemplate.img_0 = '<image preserveAspectRatio="xMidYMid slice" xlink:href="{val}" x="0" y="0" width="102" height="150"></image>';

            OrgChart.templates.myTemplate.html = '<foreignobject class="node" x="100" y="0" width="170" height="100%">{val}</foreignobject>';


            OrgChart.MIXED_LAYOUT_ALL_NODES = false;
            var chart = new OrgChart(document.getElementById("tree"), {
                showXScroll: OrgChart.scroll.visible,
                showYScroll: OrgChart.scroll.visible,
                mouseScrool: OrgChart.action.scroll,
                scaleInitial: OrgChart.match.boundary,
                enableSearch: false,
                template: "myTemplate",
                menu: {
                    pdfPreview: {
                        text: "PDF Preview",
                        icon: OrgChart.icon.pdf(24, 24, '#7A7A7A'),
                        onClick: preview
                    },
                    pdf: {
                        text: 'A4 PDF',
                        icon: OrgChart.icon.pdf(24, 24),
                        onClick: function() {
                            chart.exportPDF({
                                header: 'Bagan Organisasi',
                                footer: 'simpeg.sanggau.go.id',
                                format: 'A4',
                                margin: [60, 20, 60, 20]
                            });
                        }
                    }
                    // pdf: {
                    //     text: "Export PDF"
                    // },
                    // png: {
                    //     text: "Export PNG"
                    // },
                    // svg: {
                    //     text: "Export SVG"
                    // },
                    // csv: {
                    //     text: "Export CSV"
                    // }
                },
                // nodeMenu: {
                //     pdf: {
                //         text: "Export PDF"
                //     },
                //     png: {
                //         text: "Export PNG"
                //     },
                //     svg: {
                //         text: "Export SVG"
                //     }
                // },
                nodeBinding: {
                    header1: 'header1',
                    header2: 'header2',
                    img_0: "photo1",
                    html: "html",
                },
                tags: {
                    <?php foreach ($level->result() as $key) { ?> "<?= $key->bagan_level ?>": {
                            subLevels: <?= $key->bagan_level ?>,
                        },
                    <?php } ?>
                },
                nodes: [
                    <?php foreach ($bagan->result() as $key) {


                        $JPG = str_replace('.jpg', '.JPG',  $key->pegawai_foto_kpe);
                        //                                                    if (!blank($key->pegawai_foto_kpe)) {
                        if (file_exists(('assets/images/' . $key->pegawai_foto_kpe))) {
                            $fotokpe = 'assets/images/' . $key->pegawai_foto_kpe;
                        } else if (file_exists(('assets/images/' . $JPG))) {
                            $fotokpe = 'assets/images/' . $JPG;
                        } else {
                            $foto = str_replace(".jpg", ".jpeg", $key->pegawai_foto_kpe);
                            if (file_exists(('assets/images/' . $foto))) {
                                $fotokpe = 'assets/images/' . $foto;
                            } else {
                                $fotokpe = 'assets/images/' . 'user.jpg';
                            }
                        }
                        //                                                    } else {
                        //                                                        $fotokpe = 'default.jpg';
                        //                                                    }
                    ?> {
                            id: "<?= $key->bagan_id ?>",
                            pid: "<?= $key->bagan_parent_id ?>",
                            tags: ["<?= $key->bagan_level ?>"],
                            name: "<?= $key->pegawai_nama ?>",
                            photo1: "<?= 'http://simpeg.sanggau.go.id/' . $fotokpe ?>",
                            photo1: "<?= base_url($fotokpe) ?>",
                            html: "<div><table width='175'><tr style='background-color: #2323; text-align: center; font-size: 11px;' height='40' ><td><b><?= $key->pegawai_jabatan_nama ?><b></td></tr><tr style='text-align: center; font-size: 11px;'><td><b><?= $key->pegawai_nama ?></b><td></tr><tr style='text-align: center; font-size: 11px;'><td>NIP : <?= $key->pegawai_nip ?> / <?= $key->pegawai_pendidikan_terakhir_tingkat ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>TTL : <?= $key->pegawai_tempat_lahir ?>, <?= date('d-m-Y', strtotime($key->pegawai_tgl_lahir)) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>TMT. JAB : <?= date('d-m-Y', strtotime($key->pegawai_jabatan_tmt)) ?><td></tr><tr style='text-align: center; font-size: 11px;'><td>GOL. : <?= $key->pegawai_pangkat_terakhir_golru ?>, TMT : <?= date('d-m-Y', strtotime($key->pegawai_pangkat_terakhir_tmt)) ?><td></tr></table><br></div>"
                        },
                    <?php } ?>
                ]
            });

            chart.on('init', function() {
                preview();
            })

            function preview() {
                OrgChart.pdfPrevUI.show(chart, {
                    format: 'A4'
                });
            }
        };
    </script>
</body>

</html>