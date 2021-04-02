/// <reference types="cypress" />

describe('Prueba el formulario de contacto', () => {
    it('Prueba la pagina de contacto y el envio de Emails', () => {
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Formulario de Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Contacto');

        cy.get('[data-cy="formulario-contacto"]').should('exist');
    });

    //Telefono
    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Abril Liv Xeder');
        cy.get('[data-cy="input-mensaje"]').type('Hola, Deseo comprar una casa');
        cy.get('[data-cy="input-opciones"]').select('Compra');
        cy.get('[data-cy="input-precio"]').type(5000000);


        cy.get('[data-cy="forma-contacto"]').eq(0).check();
        cy.wait(1500);
        cy.get('[data-cy="input-telefono"]').type(4521234567890);
        cy.get('[data-cy="input-fecha"]').type('2021-06-20');
        cy.get('[data-cy="input-hora"]').type('16:20');

        cy.get('[data-cy="formulario-contacto"]').submit();
        cy.wait(1500);
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'El mensaje se envio correctamente');
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');
    });

    //Email
    it('Llena los campos del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Abril Liv Xeder');
        cy.get('[data-cy="input-mensaje"]').type('Hola, Deseo comprar una casa');
        cy.get('[data-cy="input-opciones"]').select('Compra');
        cy.get('[data-cy="input-precio"]').type(5000000);


        cy.get('[data-cy="forma-contacto"]').eq(1).check();
        cy.wait(1500);
        cy.get('[data-cy="input-email"]').type('correo@correo.com');
        cy.get('[data-cy="formulario-contacto"]').submit();

        cy.wait(1500);
        cy.get('[data-cy="alerta-envio-formulario"]').should('exist');
        cy.get('[data-cy="alerta-envio-formulario"]').invoke('text').should('equal', 'El mensaje se envio correctamente');
        cy.get('[data-cy="alerta-envio-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');
    });
});