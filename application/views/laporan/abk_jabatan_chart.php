<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Tree view from unordered list</title>
  <link rel="stylesheet" href="<?= base_url('assets/plugins/abkchart') ?>/style.css">
  <!-- <link rel="stylesheet" href="./orgjs.css"> -->
  <script type="text/javascript" src="<?= base_url('assets/plugins/abkchart') ?>/jspdf.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/plugins/abkchart') ?>/html2canvas.js"></script>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div id="html-content">
    <figure>
      <figcaption>Example DOM structure diagram</figcaption>
      <div class="orgchart">
        <ul class="nodes">
          <li>
            <code>
              <div class="equal">
                <div class="title">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                <div class="content">
                  <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                </div>
              </div>
            </code>
            <ul class="connector"><li></li></ul>
            <ul class="after-assistant">
              <li>
                <code>
                  <div class="equal">
                    <div class="title">KEPALA BADAN </div>
                    <div class="content">
                      <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                    </div>
                  </div>
                </code>
                <ul>
                  <li>
                    <code>
                      <div class="equal">
                        <div class="title">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                        <div class="content">
                          <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                        </div>
                      </div>
                    </code>
                    <ul>
                      <li><code>h1</code></li>
                      <li><code>p</code></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li>
                <code>
                  <div class="equal">
                    <div class="title">KEPALA BADAN</div>
                    <div class="content">
                      <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                    </div>
                  </div>
                </code>
                <ul>
                  <li>
                    <code>
                      <div class="equal">
                        <div class="title">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA<br> MANUSIA</div>
                        <div class="content">
                          <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                        </div>
                      </div>
                    </code></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <!-- <div class="connector"></div> -->
            <assistant>
              <div class="equal">
                <div class="title">SEKRETARIS INSPEKTORAT </div>
                <div class="content">
                  <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                </div>
              </div>
            </assistant>
            <ul>
              <li>
                <code>
                  <div class="equal">
                    <div class="title">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                    <div class="content">
                      <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                    </div>
                  </div>
                </code></li>
                <li>
                  <code>
                    <div class="equal">
                      <div class="title">KEPALA BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                      <div class="content">
                        <table width="100%"><tbody><tr><td>K= 1</td><td>B= 1</td></tr></tbody></table>
                      </div>
                    </div>
                  </code></li>
            </ul>
          </li>
        </ul>
      </div>
    </figure>

  </div>
  <a href="javascript:genPDF()">Download PDF</a>
  <button type="butoon" onclick="CreatePDFfromHTML()">Cetak</button>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
  
<script>
  function genPDF() {
    var printContents = document.getElementById('html-content').innerHTML;
    //  var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    //  document.body.innerHTML = originalContents;

  }
  //Create PDf from HTML...
  function CreatePDFfromHTML() {
    var HTML_Width = $("#html-content").width();
    var HTML_Height = $("#html-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    const div = document.getElementById('html-content');
    const options = { background: 'white', height: PDF_Height, width: PDF_Width };
    domtoimage.toPng(div, options).then((dataUrl) => {
        //Initialize JSPDF
        const doc = new jsPDF('l', 'mm', 'a4');
        //Add image Url to PDF
        doc.addImage(dataUrl, 'PNG', 0, 0, 210, 340);
        doc.save('pdfDocument.pdf');
    });
    
    // var pdf = new jsPDF('p', 'pt', 'letter');
    // pdf.addHTML($('.html-content')[0], function () {
    //   pdf.save('Test.pdf');
    // });
    // html2canvas($("#html-content")[0]).then(function (canvas) {
    // var imgData = canvas.toDataURL("image/jpeg", 1.0);
    // var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
    // pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
    // for (var i = 1; i <= totalPDFPages; i++) { 
    //     pdf.addPage(PDF_Width, PDF_Height);
    //     pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    // }
    // pdf.save("Your_PDF_Name.pdf");
    // $(".html-content").hide();
    // });
  }
</script>