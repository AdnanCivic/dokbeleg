export default {
    create(bausteine){
        const doc = new PDFDocument();
        var stream = doc.pipe(blobStream());

        doc.text('testo', 100, 300).font('Times-Roman', 13).moveDown()
            .text('texto', {
                width: 412,
                align: 'justify',
                indent: 30,
                columns: 2,
                height: 300,
                ellipsis: true
            });

        doc.end();

        const pdf = stream.on('finish', function() {
            // $('#pdfModal').modal({backdrop: 'static'});
            // document.getElementById('document').src = stream.toBlobURL('application/pdf');
            return stream.toBlob('application/pdf');
            
        });
        
        return pdf;
        
    }
}