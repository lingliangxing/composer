<?php

namespace PhpZip;

use PhpZip\Constants\ZipCompressionLevel;
use PhpZip\Constants\ZipCompressionMethod;
use PhpZip\Constants\ZipEncryptionMethod;
use PhpZip\Exception\ZipEntryNotFoundException;
use PhpZip\Exception\ZipException;
use PhpZip\Model\ZipEntry;
use PhpZip\Model\ZipEntryMatcher;
use PhpZip\Model\ZipInfo;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Finder\Finder;

/**
 * Create, open .ZIP files, modify, get info and extract files.
 *
 * Implemented support traditional PKWARE encryption and WinZip AES encryption.
 * Implemented support ZIP64.
 * Support ZipAlign functional.
 *
 * @see https://pkware.cachefly.net/webdocs/casestudies/APPNOTE.TXT .ZIP File Format Specification
 *
 * @author Ne-Lexa alexey@nelexa.ru
 * @license MIT
 *
 * @deprecated will be removed in version 4.0. Use the {@see ZipFile} class.
 */
interface ZipFileInterface extends \Countable, \ArrayAccess, \Iterator
{
    /**
     * Method for Stored (uncompressed) entries.
     *
     * @see ZipEntry::setCompressionMethod()
     * @deprecated Use {@see ZipCompressionMethod::STORED}
     */
    const METHOD_STORED = ZipCompressionMethod::STORED;

    /**
     * Method for Deflated compressed entries.
     *
     * @see ZipEntry::setCompressionMethod()
     * @deprecated Use {@see ZipCompressionMethod::DEFLATED}
     */
    const METHOD_DEFLATED = ZipCompressionMethod::DEFLATED;

    /**
     * Method for BZIP2 compressed entries.
     * Require php extension bz2.
     *
     * @see ZipEntry::setCompressionMethod()
     * @deprecated Use {@see ZipCompressionMethod::BZIP2}
     */
    const METHOD_BZIP2 = ZipCompressionMethod::BZIP2;

    /**
     * @var int default compression level
     *
     * @deprecated Use {@see ZipCompressionLevel::NORMAL}
     */
    const LEVEL_DEFAULT_COMPRESSION = ZipCompressionLevel::NORMAL;

    /**
     * Compression level for fastest compression.
     *
     * @deprecated Use {@see ZipCompressionLevel::FAST}
     */
    const LEVEL_FAST = ZipCompressionLevel::FAST;

    /**
     * Compression level for fastest compression.
     *
     * @deprecated Use {@see ZipCompressionLevel::SUPER_FAST}
     */
    const LEVEL_BEST_SPEED = ZipCompressionLevel::SUPER_FAST;

    /** @deprecated Use {@see ZipCompressionLevel::SUPER_FAST} */
    const LEVEL_SUPER_FAST = ZipCompressionLevel::SUPER_FAST;

    /**
     * Compression level for best compression.
     *
     * @deprecated Use {@see ZipCompressionLevel::MAXIMUM}
     */
    const LEVEL_BEST_COMPRESSION = ZipCompressionLevel::MAXIMUM;

    /**
     * No specified method for set encryption method to Traditional PKWARE encryption.
     *
     * @deprecated Use {@see ZipEncryptionMethod::PKWARE}
     */
    const ENCRYPTION_METHOD_TRADITIONAL = ZipEncryptionMethod::PKWARE;

    /**
     * No specified method for set encryption method to WinZip AES encryption.
     * Default value 256 bit.
     *
     * @deprecated Use {@see ZipEncryptionMethod::WINZIP_AES_256}
     */
    const ENCRYPTION_METHOD_WINZIP_AES = ZipEncryptionMethod::WINZIP_AES_256;

    /**
     * No specified method for set encryption method to WinZip AES encryption 128 bit.
     *
     * @deprecated Use {@see ZipEncryptionMethod::WINZIP_AES_128}
     */
    const ENCRYPTION_METHOD_WINZIP_AES_128 = ZipEncryptionMethod::WINZIP_AES_128;

    /**
     * No specified method for set encryption method to WinZip AES encryption 194 bit.
     *
     * @deprecated Use {@see ZipEncryptionMethod::WINZIP_AES_192}
     */
    const ENCRYPTION_METHOD_WINZIP_AES_192 = ZipEncryptionMethod::WINZIP_AES_192;

    /**
     * No specified method for set encryption method to WinZip AES encryption 256 bit.
     *
     * @deprecated Use {@see ZipEncryptionMethod::WINZIP_AES_256}
     */
    const ENCRYPTION_METHOD_WINZIP_AES_256 = ZipEncryptionMethod::WINZIP_AES_256;

    /**
     * Open zip archive from file.
     *
     * @param string $filename
     * @param array  $options
     *
     * @throws ZipException if can't open file
     *
     * @return ZipFile
     */
    public function openFile($filename, array $options = []);

    /**
     * Open zip archive from raw string data.
     *
     * @param string $data
     * @param array  $options
     *
     * @throws ZipException if can't open temp stream
     *
     * @return ZipFile
     */
    public function openFromString($data, array $options = []);

    /**
     * Open zip archive from stream resource.
     *
     * @param resource $handle
     * @param array    $options
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function openFromStream($handle, array $options = []);

    /**
     * @return string[] returns the list files
     */
    public function getListFiles();

    /**
     * @return int returns the number of entries in this ZIP file
     */
    public function count();

    /**
     * Returns the file comment.
     *
     * @return string|null the file comment
     */
    public function getArchiveComment();

    /**
     * Set archive comment.
     *
     * @param string|null $comment
     *
     * @return ZipFile
     */
    public function setArchiveComment($comment = null);

    /**
     * Checks if there is an entry in the archive.
     *
     * @param string $entryName
     *
     * @return bool
     */
    public function hasEntry($entryName);

    /**
     * Returns ZipEntry object.
     *
     * @param string $entryName
     *
     * @throws ZipEntryNotFoundException
     *
     * @return ZipEntry
     */
    public function getEntry($entryName);

    /**
     * Checks that the entry in the archive is a directory.
     * Returns true if and only if this ZIP entry represents a directory entry
     * (i.e. end with '/').
     *
     * @param string $entryName
     *
     * @throws ZipEntryNotFoundException
     *
     * @return bool
     */
    public function isDirectory($entryName);

    /**
     * Returns entry comment.
     *
     * @param string $entryName
     *
     * @throws ZipException
     * @throws ZipEntryNotFoundException
     *
     * @return string
     */
    public function getEntryComment($entryName);

    /**
     * Set entry comment.
     *
     * @param string      $entryName
     * @param string|null $comment
     *
     * @throws ZipEntryNotFoundException
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function setEntryComment($entryName, $comment = null);

    /**
     * Returns the entry contents.
     *
     * @param string $entryName
     *
     * @throws ZipEntryNotFoundException
     * @throws ZipException
     *
     * @return string
     */
    public function getEntryContents($entryName);

    /**
     * @param string $entryName
     *
     * @throws ZipEntryNotFoundException
     * @throws ZipException
     *
     * @return resource
     */
    public function getEntryStream($entryName);

    /**
     * Get info by entry.
     *
     * @param string|ZipEntry $entryName
     *
     * @throws ZipException
     * @throws ZipEntryNotFoundException
     *
     * @return ZipInfo
     */
    public function getEntryInfo($entryName);

    /**
     * Get info by all entries.
     *
     * @return ZipInfo[]
     */
    public function getAllInfo();

    /**
     * @return ZipEntryMatcher
     */
    public function matcher();

    /**
     * Extract the archive contents (unzip).
     *
     * Extract the complete archive or the given files to the specified destination.
     *
     * @param string            $destDir          location where to extract the files
     * @param array|string|null $entries          entries to extract
     * @param array             $options          extract options
     * @param array             $extractedEntries if the extractedEntries argument
     *                                            is present, then the  specified
     *                                            array will be filled with
     *                                            information about the
     *                                            extracted entries
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function extractTo($destDir, $entries = null, array $options = [], &$extractedEntries = []);

    /**
     * Add entry from the string.
     *
     * @param string   $entryName         zip entry name
     * @param string   $contents          string contents
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}.
     *                                    If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function addFromString($entryName, $contents, $compressionMethod = null);

    /**
     * @param Finder $finder
     * @param array  $options
     *
     * @throws ZipException
     *
     * @return ZipEntry[]
     */
    public function addFromFinder(Finder $finder, array $options = []);

    /**
     * @param \SplFileInfo $file
     * @param string|null  $entryName
     * @param array        $options
     *
     * @throws ZipException
     *
     * @return ZipEntry
     */
    public function addSplFile(\SplFileInfo $file, $entryName = null, array $options = []);

    /**
     * Add entry from the file.
     *
     * @param string      $filename          destination file
     * @param string|null $entryName         zip Entry name
     * @param int|null    $compressionMethod Compression method.
     *                                       Use {@see ZipCompressionMethod::STORED},
     *                                       {@see ZipCompressionMethod::DEFLATED} or
     *                                       {@see ZipCompressionMethod::BZIP2}.
     *                                       If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function addFile($filename, $entryName = null, $compressionMethod = null);

    /**
     * Add entry from the stream.
     *
     * @param resource $stream            stream resource
     * @param string   $entryName         zip Entry name
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}.
     *                                    If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function addFromStream($stream, $entryName, $compressionMethod = null);

    /**
     * Add an empty directory in the zip archive.
     *
     * @param string $dirName
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function addEmptyDir($dirName);

    /**
     * Add directory not recursively to the zip archive.
     *
     * @param string   $inputDir          Input directory
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *
     *                                    Use {@see ZipCompressionMethod::STORED}, {@see
     *     ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     */
    public function addDir($inputDir, $localPath = '/', $compressionMethod = null);

    /**
     * Add recursive directory to the zip archive.
     *
     * @param string   $inputDir          Input directory
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED}, {@see
     *                                    ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     *
     * @see ZipCompressionMethod::STORED
     * @see ZipCompressionMethod::DEFLATED
     * @see ZipCompressionMethod::BZIP2
     */
    public function addDirRecursive($inputDir, $localPath = '/', $compressionMethod = null);

    /**
     * Add directories from directory iterator.
     *
     * @param \Iterator $iterator          directory iterator
     * @param string    $localPath         add files to this directory, or the root
     * @param int|null  $compressionMethod Compression method.
     *                                     Use {@see ZipCompressionMethod::STORED}, {@see
     *                                     ZipCompressionMethod::DEFLATED} or
     *                                     {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     *
     * @see ZipCompressionMethod::STORED
     * @see ZipCompressionMethod::DEFLATED
     * @see ZipCompressionMethod::BZIP2
     */
    public function addFilesFromIterator(\Iterator $iterator, $localPath = '/', $compressionMethod = null);

    /**
     * Add files from glob pattern.
     *
     * @param string   $inputDir          Input directory
     * @param string   $globPattern       glob pattern
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     * @sse https://en.wikipedia.org/wiki/Glob_(programming) Glob pattern syntax
     */
    public function addFilesFromGlob($inputDir, $globPattern, $localPath = '/', $compressionMethod = null);

    /**
     * Add files recursively from glob pattern.
     *
     * @param string   $inputDir          Input directory
     * @param string   $globPattern       glob pattern
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     * @sse https://en.wikipedia.org/wiki/Glob_(programming) Glob pattern syntax
     */
    public function addFilesFromGlobRecursive($inputDir, $globPattern, $localPath = '/', $compressionMethod = null);

    /**
     * Add files from regex pattern.
     *
     * @param string   $inputDir          search files in this directory
     * @param string   $regexPattern      regex pattern
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     *
     * @internal param bool $recursive Recursive search
     */
    public function addFilesFromRegex($inputDir, $regexPattern, $localPath = '/', $compressionMethod = null);

    /**
     * Add files recursively from regex pattern.
     *
     * @param string   $inputDir          search files in this directory
     * @param string   $regexPattern      regex pattern
     * @param string   $localPath         add files to this directory, or the root
     * @param int|null $compressionMethod Compression method.
     *                                    Use {@see ZipCompressionMethod::STORED},
     *                                    {@see ZipCompressionMethod::DEFLATED} or
     *                                    {@see ZipCompressionMethod::BZIP2}. If null, then auto choosing method.
     *
     * @throws ZipException
     *
     * @return ZipFile
     *
     * @internal param bool $recursive Recursive search
     */
    public function addFilesFromRegexRecursive($inputDir, $regexPattern, $localPath = '/', $compressionMethod = null);

    /**
     * Add array data to archive.
     * Keys is local names.
