function xmlToJ(xml) {


    var obj = {}, i, j, attribute, item, nodeName, old;

    if (xml.nodeType === 1) { // element
        // do attributes
        if (xml.attributes.length > 0) {
            obj["@attributes"] = {};
            for (j = 0; j < xml.attributes.length; j = j + 1) {
                attribute = xml.attributes.item(j);
                obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
            }
        }
    } else if (xml.nodeType === 3) { // text
        obj = xml.nodeValue.trim();
    }

    // do children
    if (xml.hasChildNodes()) {
        for (i = 0; i < xml.childNodes.length; i = i + 1) {
            item = xml.childNodes.item(i);
            nodeName = item.nodeName;
            if ((obj[nodeName]) === undefined) {
                obj[nodeName] = xmlToJ(item);
            } else {
                if ((obj[nodeName].push) === undefined) {
                    old = obj[nodeName];
                    obj[nodeName] = [];
                    obj[nodeName].push(old);
                }
                obj[nodeName].push(xmlToJ(item));
            }
        }
    }
    return obj;
}

function getFilmes() {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.open('GET', 'cursos.xml');
    xmlHttp.onreadystatechange = () => {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            let XMLCursos = xmlHttp.responseText;

            let parser = new DOMParser();
            domCursos = parser.parseFromString(XMLCursos, 'text/xml');
            jsonCursos = xmlToJ(domCursos);
            for (let i in jsonCursos['cursos']['curso']) {
                let divRow = document.createElement('div');
                divRow.className = 'row';
                let divCol = document.createElement('div');
                divCol.className = 'col';
                let p1 = document.createElement('p');
                let p2 = document.createElement('p');
                p1.innerHTML = '<strong>Nome: </strong> ' + jsonCursos['cursos']['curso'][i]['nome']['#text'];
                p2.innerHTML = '<strong>Código: </strong> ' + jsonCursos['cursos']['curso'][i]['codigo']['#text'];
                let hr = document.createElement('hr');
                divRow.appendChild(divCol);
                divCol.appendChild(p1);
                divCol.appendChild(p2);
                document.getElementById('lista').appendChild(divRow);
            }
        }

        if (xmlHttp.readyState == 4 && xmlHttp.status == 404) {

        }
    }
    xmlHttp.send();

}
