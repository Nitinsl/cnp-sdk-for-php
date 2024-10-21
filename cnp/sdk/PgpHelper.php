<?php

namespace cnp\sdk;
use Exception;

class PgpHelper
{
    /*
     * Encrypt input file using "gpg" with the given public key
     */
    public static function encrypt($encryptInput, $encryptOutput, $publicKey){
        $command = "gpg --batch --yes --quiet --no-secmem-warning --armor --output " .$encryptOutput.
            " --recipient ".$publicKey.
            " --trust-model always --encrypt ".$encryptInput." 2>&1";

        exec($command, $output, $result);
        if($result != 0){
            $response = "";
            foreach ($output as $line){
                $response .= $line . "\n";
            }
            throw new \RuntimeException ("The batch file could not be encrypted. Check the public key entered. ".$response);
        }
    }

    /*
     * Decrypt input file using "gpg" with the given passphrase
     */
    public static function decrypt($decryptInput, $decryptOutput, $passphrase){
        $command = "gpg --batch --yes --quiet --no-secmem-warning --no-mdc-warning  --output ".$decryptOutput.
            " --passphrase ".$passphrase.
            " --decrypt ".$decryptInput." 2>&1";

        exec($command, $output, $result);
        if($result != 0){
            $response = "";
            foreach ($output as $line){
                $response .= $line . "\n";
            }
            throw new \RuntimeException ("The response could not be decrypted. ".$response);
        }
    }

    /*
     * Import input key file into "gpg" keyring
     */
    public static function importKey($keyFile){
        $command = "gpg --import ".$keyFile. " 2>&1";
        exec($command, $output, $result);
        if($result != 0){
            $response = "";
            foreach ($output as $line){
                $response .= $line . "\n";
            }
            throw new \RuntimeException ("The key could not be imported. ".$response);
        }
        $split = explode(" ", $output[0]);
        return rtrim($split[2], ":");
    }

    public static function encryptPayload($encryptInput, $publicKey)
    {
        // Open a process to gpg with pipes
        $descriptorspec = [
            0 => ["pipe", "r"],  // stdin is a pipe that the child will read from
            1 => ["pipe", "w"],  // stdout is a pipe that the child will write to
            2 => ["pipe", "w"]   // stderr is a pipe that the child will write to
        ];

        $process = proc_open("gpg --batch --yes --quiet --no-secmem-warning --armor --trust-model always --recipient-file $publicKey --encrypt", $descriptorspec, $pipes);

        if (is_resource($process)) {
            // Write the input string to the stdin of the process
            fwrite($pipes[0], $encryptInput);
            fclose($pipes[0]);

            // Read the encrypted content from the stdout of the process
            $encryptedString = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Read any errors from the stderr of the process
            $errors = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            // Close the process
            $return_value = proc_close($process);

            if ($return_value != 0) {
                throw new \RuntimeException("Encrypting the payload has failed" . $errors);
            }
            return $encryptedString;
        } else {
            throw new \RuntimeException("Encrypting the payload has failed. Please check the Encryption key or key path, is correct!\n");
        }
    }
}
