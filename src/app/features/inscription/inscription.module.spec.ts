import { InscriptionModule } from './inscription.module';

describe('InscriptionModule', () => {
  let inscriptionModule: InscriptionModule;

  beforeEach(() => {
    inscriptionModule = new InscriptionModule();
  });

  it('should create an instance', () => {
    expect(inscriptionModule).toBeTruthy();
  });
});
