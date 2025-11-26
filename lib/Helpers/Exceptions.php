<?php
namespace FactPulse\SDK\Helpers;

class FactPulseException extends \Exception {}

class FactPulseAuthException extends FactPulseException {
    public function __construct(string $message = "Erreur d'authentification") { parent::__construct($message); }
}

class FactPulsePollingTimeoutException extends FactPulseException {
    public string $taskId;
    public int $timeout;
    public function __construct(string $taskId, int $timeout) {
        $this->taskId = $taskId;
        $this->timeout = $timeout;
        parent::__construct("Timeout ({$timeout}ms) atteint pour la tâche {$taskId}");
    }
}

class ValidationErrorDetail {
    public string $level = '';
    public string $item = '';
    public string $reason = '';
    public ?string $source = null;
    public ?string $code = null;

    public function __toString(): string {
        return "[" . ($this->item ?: 'unknown') . "] " . ($this->reason ?: 'Unknown error');
    }

    public static function fromArray(array $data): self {
        $d = new self();
        $d->level = $data['level'] ?? '';
        $d->item = $data['item'] ?? '';
        $d->reason = $data['reason'] ?? '';
        $d->source = $data['source'] ?? null;
        $d->code = $data['code'] ?? null;
        return $d;
    }
}

class FactPulseValidationException extends FactPulseException {
    /** @var ValidationErrorDetail[] */
    public array $errors;

    public function __construct(string $message, array $errors = []) {
        $this->errors = $errors;
        $fullMessage = $message;
        if (!empty($errors)) {
            $details = array_map(fn($e) => "  - " . (string)$e, $errors);
            $fullMessage .= "\n\nDétails:\n" . implode("\n", $details);
        }
        parent::__construct($fullMessage);
    }
}
