window.onload = function(){
    document.getElementById("pdf_button").addEventListener("click"
    , ()=>{
            const topdf = this.document.getElementById("topdf");
            var opt = {
                margin: 1,
                filename: 'itinerarios.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(topdf).set(opt).save();
        })

}