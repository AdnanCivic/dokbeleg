export default {
    
    createPdf(bausteine, dokument) {
        let text = '';
        const doc = new PDFDocument({
            bufferPages: true
        });

        let stream = doc.pipe(blobStream());

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
            doc.text(`Seite ${i + 1} / ${range.count}`, 470, 20);
        }

        doc.end();

        stream.on('finish', function() {
            const url = stream.toBlobURL('application/pdf');
            $('#pdfModal').modal({backdrop: 'static'});
            document.getElementById('document').src = url;

            $(".download").remove();
            let download = $("<a class='btn btn-sm btn-primary download'>Download</a>").attr({
                "href": url,
                "download": dokument.name
                });
            download.insertBefore(document.querySelector("#document"));
        });

    },

    formatDeckblatt(doc, baustein){
        let text = '';
        text = doc
                .fontSize(24)
                .moveDown(5)
                .text(baustein[1],{//heading
                    align: 'center'
                });
        
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