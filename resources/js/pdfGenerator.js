var htmlToPdfmake = require("html-to-pdfmake");

export default {
    
    createPdf(bausteine, dokument){
        let inhaltsverzeichnis = this.getInhaltsverzeichnis(bausteine);
        let docDefinition = this.formatBausteine(bausteine, inhaltsverzeichnis);
        pdfMake.createPdf(docDefinition).download(dokument.name);

    },

    formatBausteine(bausteine, inhaltsverzeichnis){
        let docDefinitionContent = {
            header: function(currentPage, pageCount){
                        return {
                            columns: [
                                { text: 'Dokumentation', style: 'headerLeft'},
                                { text: 'Seite ' + currentPage.toString() + ' von ' + pageCount, style: 'headerRight'}
                            ]
                        }
                    },

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
                },
                headerLeft: {
                    fontSize: 11,
                    alignment: 'left',
                    margin: [40, 15]
                },
                headerRight: {
                    fontSize: 11,
                    alignment: 'right',
                    margin: [40, 15]
                }
            }
        }

        return docDefinitionContent;
    },

    stratifyContent(bausteine, inhaltsverzeichnis){
        let content = [];
        let counterHK = 0, counterOK = 0, counterUK = 0;

        bausteine.forEach((baustein) => {
            switch(baustein.typ){
                case "deckblatt":  
                    content.push({ text: baustein.heading, style: 'deckblattHeading'});
                    if(baustein.content == null){
                        content.push(htmlToPdfmake('', { defaultStyles: { img: { width: 300 } } }));
                    }else{
                        content.push(htmlToPdfmake(baustein.content, { defaultStyles: { img: { width: 300 } } }));
                    }
                    content.push({ stack: inhaltsverzeichnis, style: 'inhaltsverzeichnis', pageBreak: 'before'});
                    break;
                case "hauptkapitel":  
                    counterHK++;
                    content.push({ text: counterHK + "." + baustein.heading, style: 'hauptkapitelHeading', pageBreak: 'before'});

                    if(baustein.content == null){
                        content.push(htmlToPdfmake('', { defaultStyles: { img: { width: 300 } } }));
                    }else{
                        content.push(htmlToPdfmake(baustein.content, { defaultStyles: { img: { width: 300 } } }));
                    }

                    break;
                case "oberkapitel": 
                    counterOK++;
                    content.push({ text: counterHK + "." + counterOK + "." + baustein.heading, style: 'oberkapitelHeading'});

                    if(baustein.content == null){
                        content.push(htmlToPdfmake('', { defaultStyles: { img: { width: 300 } } }));
                    }else{
                        content.push(htmlToPdfmake(baustein.content, { defaultStyles: { img: { width: 300 } } }));
                    }

                    break;
                case "unterkapitel":
                    counterUK++;
                    content.push({ text: counterHK + "." + counterOK + "." + counterUK + "." + baustein.heading, style: 'unterkapitelHeading'});

                    if(baustein.content == null){
                        content.push(htmlToPdfmake('', { defaultStyles: { img: { width: 300 } } }));
                    }else{
                        content.push(htmlToPdfmake(baustein.content, { defaultStyles: { img: { width: 300 } } }));
                    }

                    break;
                default:
                    content.push({ text: baustein.heading, style: 'unterkapitelHeading'});

                    if(baustein.content == null){
                        content.push(htmlToPdfmake('', { defaultStyles: { img: { width: 300 } } }));
                    }else{
                        content.push(htmlToPdfmake(baustein.content, { defaultStyles: { img: { width: 300 } } }));
                    }
           }
        });

        return content;

    },

    getInhaltsverzeichnis(bausteine){
        let inhaltsverzeichnis = [];
        let counterHK = 0, counterOK = 0, counterUK = 0;
        inhaltsverzeichnis[0] = { text: "Inhaltsverzeichnis", style: 'inhaltsverzeichnisHeading'};

        bausteine.forEach((baustein) => {
            switch(baustein.typ){
                case "hauptkapitel":  
                    counterHK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + baustein.heading, style: 'inhaltsverzeichnis'});
                    break;
                case "oberkapitel": 
                    counterOK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + counterOK + "." + baustein.heading, style: 'inhaltsverzeichnis'});
                    break;
                case "unterkapitel":
                    counterUK++;
                    inhaltsverzeichnis.push({ text: counterHK + "." + counterOK + "." + counterUK + "." + baustein.heading, style: 'inhaltsverzeichnis'});
                    break;
            }
        });
        return inhaltsverzeichnis;

    }

}
