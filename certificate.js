// const generatePDF = async(name)=>{
//     const {PDFDocument,rgb} = PDFLib;

//     const exBytes = await fetch("./cert.pdf").then((res)=>{
//         return res.arrayBuffer();
//     });

//     const exFont = await fetch("./Ovo-Regular.ttf").then(res=>{
//         return res.arrayBuffer()
//     })


//     const pdfDoc = await PDFDocument.load(exBytes)

//     const uri = await pdfDoc.saveAsBase64({dataUri:true})

//     document.querySelector("#mypdf").src=uri;
// };
// generatePDF()


// const generatePDF = async (name) => {
//     const { PDFDocument, rgb, StandardFonts } = PDFLib;

//     const exBytes = await fetch("./cert.pdf").then((res) => {
//         return res.arrayBuffer();
//     });

//     const pdfDoc = await PDFDocument.load(exBytes);

//     const exFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

//     const pages = pdfDoc.getPages();
//     const firstPage = pages[0];
//     const { width, height } = firstPage.getSize();

//     firstPage.drawText(name, {
//         x: width / 2 - name.length * 5-50, // Centered horizontally
//         y: height / 2, // Centered vertically
//         size: 35,
//         font: exFont,
//         color: rgb(0, 0, 0),
//     });

//     const pdfBytes = await pdfDoc.save();

//     // Create a Blob from the PDF data
//     const pdfBlob = new Blob([pdfBytes], { type: "application/pdf" });

//     // Create a URL for the Blob
//     const pdfUrl = URL.createObjectURL(pdfBlob);

//     // Set the URL as the src attribute for the iframe
//     document.querySelector("#mypdf").src = pdfUrl;

// };

// generatePDF("Ketaki Kulkarni");


const generatePDF = async (name) => {
    const { PDFDocument, rgb, StandardFonts } = PDFLib;

    // Fetch the PDF file
    const pdfUrl = "./cert.pdf";
    const pdfBytes = await fetch(pdfUrl).then((res) => res.arrayBuffer());

    // Load the PDF document
    const pdfDoc = await PDFDocument.load(pdfBytes);
    const exFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

    // Modify the first page
    const firstPage = pdfDoc.getPages()[0];
    const { width, height } = firstPage.getSize();
    firstPage.drawText(name, {
        x: width / 2 - name.length * 5 - 50, // Centered horizontally
        y: height / 2, // Centered vertically
        size: 35,
        font: exFont,
        color: rgb(0, 0, 0),
    });

    console.log("PDF modification completed.");

    // Save the modified PDF as a new Blob
    const modifiedPdfBytes = await pdfDoc.save();
    const modifiedPdfBlob = new Blob([modifiedPdfBytes], { type: "application/pdf" });

    // Create a new Blob URL for the modified PDF
    const modifiedPdfBlobUrl = URL.createObjectURL(modifiedPdfBlob);

    console.log("Modified PDF Blob URL:", modifiedPdfBlobUrl);

    // Set the URL as the src attribute for the iframe
    document.querySelector("#mypdf").src = modifiedPdfBlobUrl;
};

// Call generatePDF function with any name
generatePDF("Ketaki Kulkarni");

