/// <references types="cypress" />

describe('Carga la pagina Principal', () => {
    it('Prueba el Header de la pagina Principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]').should('exist');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', '');
    });

    it('Prueba el bloque de los iconos principales', () => {
        cy.get('[data-cy="heading-nosotros"]').should('exist');
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('not.equal', 'H1');

        //Selecciona los iconos
        cy.get('[data-cy="iconos-nosotros"]').should('exist');
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);
    });

    it('Prueba el bloque de las Propiedades y Depas en Venta', () => {
        //Debe haber Propiedades
        cy.get('[data-cy="anuncio"]').should('have.length', 3);
        cy.get('[data-cy="anuncio"]').should('not.have.length', 4);

        cy.get('[data-cy="enlace-propiedad"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="enlace-propiedad"]').should('not.have.class', 'amarillo-block');

        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad');

        //Probar enlace a una propiedad 
        cy.get('[data-cy="enlace-propiedad"]').first().click();

        cy.get('[data-cy="titulo-propiedad"]').should('exist');

        cy.wait(1000);
        cy.go('back');
    });
})