<?php

namespace Helpz\AiIntegration\Shared\ClientAIProfile;

use Prism\Prism\Schema\BooleanSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

final class AnalyzeReportUsefulnessProfile
{
    public function getSchema(): ObjectSchema
    {
        return new ObjectSchema(
            name: 'report_usefulness',
            description: 'Indicates whether the report content is useful',
            properties: [
                new BooleanSchema(
                    name: 'is_useful',
                    description: 'True if the report is considered useful, false otherwise'
                ),
                new StringSchema(
                    name: 'reason',
                    description: 'Short explanation for the decision'
                ),
            ],
            requiredFields: ['useful']
        );
    }

    public function getContext(): string
    {
        return 'Você é um analista de informática experiente. Sua função é avaliar relatórios técnicos de atendimento e determinar se eles são úteis para análises posteriores, como identificação de falhas recorrentes em equipamentos, rede ou infraestrutura, e elaboração de soluções centralizadas.

            Um relatório é considerado útil quando contém informações técnicas objetivas, específicas e acionáveis, como:

            peças substituídas ou componentes envolvidos;

            causa identificada do problema;

            procedimentos realizados de forma clara e rastreável;

            resultados obtidos após a intervenção;

            evidências, detalhes técnicos ou diagnósticos.

            Um relatório deve ser considerado não útil quando apresenta informações vagas, genéricas ou que não ajudam a entender o problema real, como:

            “reiniciei a internet e voltou a funcionar”;

            “reiniciei a máquina e resolveu”;

            descrições muito curtas, subjetivas ou sem contexto;

            falta de detalhes técnicos que impeçam análise posterior.

            Baseie sua classificação exclusivamente na utilidade técnica do relatório e na sua capacidade de contribuir para análises futuras.';
    }

    public function getTestUselessPrompt(): string
    {
        return 'o problema era: meu computador liga, porém desliga após exatamente 15 minutos e a ação realizada foi: realizei o desligamento do computador por 30 minutos e o problema parou. equipamento funcionando';
    }
}