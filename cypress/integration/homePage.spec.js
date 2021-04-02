/// <references types="cypress" />

describe('Carga la pagina Principal', () => {
    it('Prueba el Header de la pagina Principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]');
    })
})