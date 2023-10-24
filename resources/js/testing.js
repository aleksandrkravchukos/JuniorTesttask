const puppeteer = require('puppeteer');

async function go(url) {
    const browser = await puppeteer.launch({
        headless: false,
        args: ['--no-sandbox'],
        downloadsPath: '/tmp'
    });

    const page = await browser.newPage();
    await page.setViewport({width: 1024, height: 800});
    await page.goto(url);

    const linkSelector = '#is';
    await page.waitForSelector(linkSelector);
    const link = await page.$(linkSelector);
    if (link) {
        await link.click();
    } else {
        console.error(`Element with selector '${linkSelector}' not found.`);
    }

    const linkCreateSelector = '.openModalCreate';
    await page.waitForSelector(linkCreateSelector);
    const linkCreate = await page.$(linkCreateSelector);
    if (linkCreate) {
        await linkCreate.click();
    } else {
        console.error(`Element with selector '${linkSelector}' not found.`);
    }


    // const divSelector = 'div[itemprop="description"]';
    // const divElement = await page.$(divSelector);
    //
    // const divProperties = 'div[id="product-options"]';
    // const divElementProp = await page.$(divProperties);
    //
    // let content = '';
    // let contentUa = '';
    // let properties = '';
    // let propertiesUa = '';
    //
    // if (divElement) {
    //     content = await page.evaluate(element => element.innerHTML, divElement);
    //     properties = await page.evaluate(element => element.innerHTML, divElementProp);
    //
    //     await page.goto(urlUa);
    //     const divElementUa = await page.$(divSelector);
    //     const divElementPropUa = await page.$(divProperties);
    //
    //     if (divElementUa) {
    //         contentUa = await page.evaluate(element => element.innerHTML, divElementUa);
    //         propertiesUa = await page.evaluate(element => element.innerHTML, divElementPropUa);
    //         console.log('properties = ' + propertiesUa);
    //     }
    //
    //     await browser.close();
    //     return [content, contentUa, properties, propertiesUa];
    // } else {
    //     console.log('Div not found.');
    //     await browser.close();
    //     return ['-', '-', '-', '-'];;
    // }
}

async function main() {
    let url = 'http://localhost/';
    await go(url);
}

main().then(r => console.log('Done'));
