var htmlToPdfmake = require("html-to-pdfmake");

export default {
    
    createPdf(bausteine, dokument){
        let inhaltsverzeichnis = this.getInhaltsverzeichnis(bausteine);
        let docDefinition = this.formatBausteine(bausteine, inhaltsverzeichnis);
        pdfMake.createPdf(docDefinition).download(dokument.name);

    },

    formatBausteine(bausteine, inhaltsverzeichnis){
        let docDefinitionContent = {
            content: this.stratifyContent(bausteine, inhaltsverzeichnis),
    
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
                    margin: [0, 5]
                },
                unterkapitelHeading: {
                    fontSize: 12,
                    bold: true
                },
                inhaltsverzeichnisHeading: {
                    fontSize: 14,
                    bold: true,
                    alignment: 'center',
                    margin: [0,0,0,5]
                },
                inhaltsverzeichnis: {
                    fontSize: 12,
                    margin: [0, 2]
                }
            }
        }

        return docDefinitionContent;
    },

    stratifyContent(bausteine, inhaltsverzeichnis){
        let content = [];
        let counterHK = 0, counterOK = 0, counterUK = 0;

        bausteine.forEach((baustein) => {
            switch(baustein[0]){
                case "deckblatt":  
                    content.push({ text: baustein[1], style: 'deckblattHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    content.push({ stack: inhaltsverzeichnis, style: 'inhaltsverzeichnis', pageBreak: 'before'});
                    break;
                case "hauptkapitel":  
                    counterHK++;
                    content.push({ text: counterHK + "." + baustein[1], style: 'hauptkapitelHeading', pageBreak: 'before'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                case "oberkapitel": 
                    counterOK++;
                    content.push({ text: counterHK + "." + counterOK + "." + baustein[1], style: 'oberkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                case "unterkapitel":
                    counterUK++;
                    content.push({ text: counterHK + "." + counterOK + "." + counterUK + "." + baustein[1], style: 'unterkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
                    break;
                default:
                    content.push({ text: baustein[1], style: 'unterkapitelHeading'});
                    content.push(htmlToPdfmake(baustein[2]));
           }
        });

        return content;

    },

    getInhaltsverzeichnis(bausteine){
        let inhaltsverzeichnis = [];
        let counterHK = 0, counterOK = 0, counterUK = 0;
        inhaltsverzeichnis[0] = { text: "Inhaltsverzeichnis", style: 'inhaltsverzeichnisHeading'};

        bausteine.forEach((baustein) => {
            switch(baustein[0]){
                case "hauptkapitel":  
                    counterHK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + baustein[1], style: 'inhaltsverzeichnis'});
                    break;
                case "oberkapitel": 
                    counterOK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + counterOK + "." + baustein[1], style: 'inhaltsverzeichnis'});
                    break;
                case "unterkapitel":
                    counterUK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + counterOK + "." + counterUK + "." + baustein[1], style: 'inhaltsverzeichnis'});
                    break;
            }
        });
        
        return inhaltsverzeichnis;

    }

}
