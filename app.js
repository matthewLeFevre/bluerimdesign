class SyntaxHighlight {

  constructor(source = "", dest = "") {
    this.source = source;
    this.dest   = dest;
    this.type   = source.attributes.name.nodeValue;
    if (this.type === "html") {
      this.format_html();
    } else if (this.type === "css") {
      this.format_css();
    } else {
      return null;
    }
  }

  format_html() {
    let code = this.source.innerHTML;
        code = code.replace(/\"\>/g, '\" >')
                   .replace(/</g, ' &lt;')
                   .replace(/>/g, '&gt; ')
                   .replace(/\=\"/g, '\= \"');
    let codeParts = code.split(" "),
        finished  = "";
    
    // cycles through code and applies syntax
    for (let part of codeParts) {
      
      // finds opening comment
      if (part.startsWith('&lt;!--')) {
        finished += "<em><span class='c'>" + part;

        // finds closing comment
      } else if (part.endsWith('--&gt;')) {

        finished += part + "</span></em>";
      // finds opening and closing brackets for tags
      }else if (part.startsWith('&lt;') || part.endsWith('&gt;')) {

        finished += "<span class='t'>" + part + "</span> ";

        // finds attributes in tags
      } else if(part.endsWith("=")) {

        finished += "<span class='a'>" + part + "</span>";

        // finds values to attributes or strings
      } else if (part.startsWith('"')) {

        finished += "<span class='s'>" + part + " ";

      } else if(part.endsWith('"')) {

        finished += part + "</span>"

        // Adds all other parts of the code seperated by spaces
      }else {

        finished += part + " ";
      }
    }

    this.dest.innerHTML = finished;
  }

  format_css () {
    let code = this.source.innerHTML,

    finished = "";

    // remedies line breaks & space bug
    code = code.replace(/\n/g, " \n ");

    let codeParts = code.split(" ");

    for (let part of codeParts) {
      // class
      if (part.startsWith(".")) {

          finished += "<span class='l'>"+ part + "</span> ";

      // id
      }else if (part.startsWith("#") 
                && !part.endsWith(";")) {

        finished += "<span class='t'>" + part + "</span> ";

      // property
      }else if (part.endsWith(":")) {

        finished += "<span class='a'>" + part + "</span> ";

      // value
      }else if (part.endsWith(";")) {

        finished += "<span class='s'>" + part + "</span>";

      // @ decorator 
      }else if (part.startsWith("@")) {

        finished += "<span class='t'>" + part + "</span> ";

      // comments
      } else if (part.startsWith("/*")) {
        finished += "<span class='c'>" + part + " ";
      } else if (part.endsWith("/*")) {
        finished += " " + part + "</span>";
      } else {
        finished += part + " ";
      }
      this.dest.innerHTML = finished;
    }

  }
}

window.onload = () => {
  let html_blocks = document.getElementsByName("html");
  let css_blocks  = document.getElementsByName("css");
  for( let block of html_blocks) {
    new SyntaxHighlight(block, block);
  }

  for( let block of css_blocks) {
    new SyntaxHighlight(block, block);
  }

}



