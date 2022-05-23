//Funcion Exportar Estadisticas a PDF
function ExportasPDF() {
    html2canvas(document.getElementById("myAreaChart"), {
        onrendered: function(canvas) {
            var img = canvas.toDataURL();
            var doc = new jsPDF();
            doc.text(50, 25, 'Servicios mas solicitados');
            doc.addImage(img, 'JPEG', 15, 40, 180, 160);
            doc.save('Dashboard.pdf');

        }
    })
}



//Funcion Exportar Estadisticas a PDF
function ExportasPDF1() {
    html2canvas(document.getElementById("myBarChart"), {
        onrendered: function(canvas) {
            var img = canvas.toDataURL();
            var doc = new jsPDF();
            doc.text(50, 25, 'Cantidad de servicios por Fechas');
            doc.addImage(img, 'JPEG', 15, 40, 180, 160);
            doc.save('Dashboard.pdf');

        }
    })
}