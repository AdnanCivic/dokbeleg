export default {
    
    createPdf(bausteine, dokument) {
        let text = '';
        const doc = new PDFDocument({
            bufferPages: true
        });

        doc.info['title'] = dokument.name;

        var stream = doc.pipe(blobStream());

        bausteine.forEach((baustein) => {
            switch(baustein[0]){
                case "deckblatt":
                    text += this.formatDeckblatt(doc, baustein);
                    break;
                case "hauptkapitel":
                    text += this.formatHauptkapitel(doc, baustein);
                    break;
                case "oberkapitel":
                    text += this.formatOberkapitel(doc, baustein);
                    break;
                case "unterkapitel":
                    text += this.formatUnterkapitel(doc, baustein);
                    break;
                default:
                    text += this.formatDefault(doc, baustein);
            }
        });

        const range = doc.bufferedPageRange();
        let end = range.start + range.count;
        for( let i = range.start; i < end; i++){
            doc.switchToPage(i);
            doc.text(dokument.name, 0, 20);
            doc.text(`Seite ${i + 1} von ${range.count}`, 470, 20);
        }

        doc.end();

        const pdf = stream.on('finish', function() {
            // $('#pdfModal').modal({backdrop: 'static'});
            // document.getElementById('document').src = stream.toBlobURL('application/pdf');
            const blob = stream.toBlob('application/pdf');
            return blob;
        });

        return pdf;
    },

    formatDeckblatt(doc, baustein){
        let text = '';
        text = doc
                .fontSize(24)
                .text(baustein[1],{
                    align: 'center'
                });//heading
        
        return text;
    },

    formatHauptkapitel(doc, baustein){
        let text = '';
        doc.addPage();
        text = doc
                .fontSize(16)
                .text(baustein[1])//heading
                .moveDown()
                .fontSize(11)
                .text(baustein[2]);//content  

        return text;
    },

    formatOberkapitel(doc, baustein){
        let text = '';
        text = doc
                .fontSize(12)
                .text(baustein[1])//heading
                .fontSize(11)
                .text(baustein[2]);//content

        return text;
    },

    formatUnterkapitel(doc, baustein){
        let text = '';
        text = doc
                .fontSize(12)
                .text(baustein[1])//heading
                .fontSize(11)
                .text(baustein[2]);//content

        return text;
    },

    formatDefault(doc, baustein){
        let text = '';
        text = doc
                .fontSize(12)
                .text(baustein[1])
                .fontSize(11)
                .text(baustein[2]);

        return text;
    },
}