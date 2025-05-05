<?php

function show($stuff)
{
    echo '<pre style="
        background: #f4f4f4;
        color: #333;
        padding: 16px;
        margin: 16px 0;
        border-left: 4px solid #007acc;
        border-radius: 4px;
        font-size: 14px;
        line-height: 1.5;
        font-family: Consolas, Monaco, monospace;
        white-space: pre-wrap;
        word-break: break-all;
    ">';
    print_r($stuff);
    echo '</pre>';
}
