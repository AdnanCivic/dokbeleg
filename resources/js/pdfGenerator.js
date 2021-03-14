var htmlToPdfmake = require("html-to-pdfmake");

export default {
    
    createPdf(bausteine, dokument){
        
        var docDefinition = this.formatBausteine(bausteine);
        pdfMake.createPdf(docDefinition).download(dokument.name);

    },

    formatBausteine(bausteine){
        
        let docDefinitionContent = {
            content: this.stratifyContent(bausteine),
    
            styles: {
                deckblattHeading: {
                    fontSize: 24,
                    bold: true,
                    margin: [0, 200],
                    alignment: 'center',
                },
                hauptkapitelHeading: {
                    fontSize: 16,
                    bold: true,
                },
                oberkapitelHeading: {
                    fontSize: 12,
                    bold: true,
                },
                unterkapitelHeading: {
                    fontSize: 12,
                    bold: true
                }
            }
        }

        return docDefinitionContent;
    },

    stratifyContent(bausteine){
        let content = [];

        bausteine.forEach((baustein) => {
            switch(baustein[0]){
                case "deckblatt":  
                    content.push({ text: baustein[1], style: 'deckblattHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                case "hauptkapitel":  
                    content.push({ text: baustein[1], style: 'hauptkapitelHeading', pageBreak: 'before'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                case "oberkapitel": 
                    content.push({ text: baustein[1], style: 'oberkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                case "unterkapitel":
                    content.push({ text: baustein[1], style: 'unterkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                default:
                    content.push({ text: baustein[1], style: 'unterkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
           }
        });

        return content;
 
    }

}
